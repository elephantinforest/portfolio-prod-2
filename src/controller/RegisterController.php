<?php
class RegisterController extends Controller
{
    public function index()
    {
        session_start();
        //POSTされた値などを取得
        $user_id = intval($_SESSION['login_user']['id']);
        $locationId = $_POST['location_id'];
        $windowWidth = $_POST['window_width'];
        $windowHeight = $_POST['window_height'];
        $other = $_POST['other'];
        $files = $_FILES['image'];
        $fileName = basename($files['name']);
        $savePath = $this->heleper->crateRegisterSaveFile($fileName);
        $files['savePath'] = $savePath;
        //APIに接続。名前などを取得
        try {
            $userModel = $this->databaseManager->get('google');
            $res =  $userModel->getPictureJSon($files['tmp_name']);
            $name = $res['name'];
            $genre = $res['genre'];
            $price = intval($res['price']);
        } catch (PDOException $e) {
            $this->heleper->handleError($e->getMessage());
        }
        $registers = [
            'user_id' => $user_id,
            'name' =>  $name,
            'genre' => $genre,
            'price' => $price,
            'file_name' => $fileName,
            'file_path' => $savePath,
            'other' => $other,
            'location_id' => $locationId,
        ];
        //バリデーション処理
        $fileErrors = $this->validation->fileValidation($files);
        $registerErrors = $this->validation->validateRegister($registers);
        //バリデーションerrorなかったらテーブルにレコードを登録
        if (empty($fileErrors) && empty($registerErrors)) {
            try {
                $registerModel = $this->databaseManager->get('Register');
                $resizeModel = $this->databaseManager->get('Resize');
                //テーブルにレコードを登録
                $registerModel->insert($registers);
                //インサートしたレジスターIDを取得
                $registerId = $registerModel->getInsertId();
                //画像サイズを初期化
                $data = [
                    'registerId' => $registerId,
                    'width' => 90,
                    'height' => 100,
                    'window_width' => $windowWidth,
                    'window_height' => $windowHeight,
                ];
                $resizeModel->insert($data);
                //画像ファイルをエンコーディング
                $createPath = $this->heleper->createPath($savePath);
                //ブラウザに返すJSON
                $data = ['success' => true, 'imageUrl' => $createPath, 'registerId' => $registerId];
                $this->heleper->sendResponse($data);
                exit();
            } catch (PDOException $e) {
                $this->heleper->handleError($e->getMessage());
            }
        }
    }
    public function update()
    {
        if (!$this->request->isPost()) {
            return $this->render([
                'title' => '所持品の登録',
                'errors' => [],
            ]);
        }
        session_start();
        // $user_id = $_SESSION['login_user']['id'];
        $registerId = $_POST['registerId'];
        $locationID = $_POST['locationId'];
        $xPosition = $_POST['x'];
        $yPosition = $_POST['y'];


        if (empty($errors)) {
            $registerModel = $this->databaseManager->get('Register');
            $positionModel = $this->databaseManager->get('Position');
            $register = $registerModel->fetchRegister($registerId);
            $registerName = $register['name'];
            $savePath = $register['file_path'];
            $registerModel->update($locationID, $registerId);
            $registers = [
                'registerId' => $registerId,
                'x' => $xPosition,
                'y' => $yPosition,
            ];
            $positionModel->insertPosition($registers);
            $savePath = $this->heleper->createPath($savePath);
            $data = ['success' => true, 'imageUrl' => $savePath, 'registerName' => $registerName, 'registerId' => $registerId, 'x' => $xPosition, 'y' => $yPosition];
            if (isset($_POST['test'])) {
                $this->heleper->isTestTrue();
            }
            $this->heleper->sendResponse($data);
        }
    }

    public function name()
    {
        if (!$this->request->isPost()) {
            return $this->render([
                'title' => '所持品の登録',
                'errors' => [],
            ]);
        }
        session_start();
        $user_id = $_SESSION['login_user']['id'];
        $locationId = $_POST['locationId'];
        $registerModel = $this->databaseManager->get('Register');
        $userRegisters = $registerModel->fetchLocationRegister($user_id, $locationId);
        foreach ($userRegisters as $num => $register) {
            foreach ($register as $key => $value) {
                if ($key === 'file_path') {
                    $createPathInstance = new CreatePath();
                    $validPath = $createPathInstance->createPath($value);
                    $userRegisters[$num][$key] = $validPath;
                }
            }
        }
        $data = ['success' => true, 'registers' => $userRegisters];
        $this->heleper->sendResponse($data);
    }

    public function position()
    {
        // if ($this->request->isPost()) {
        //     return $this->render([
        //         'title' => '所持品の登録',
        //         'errors' => [],
        //     ]);
        // }
        $x_Position = $_POST['x'];
        $y_Position = $_POST['y'];
        $registerId = $_POST['register_id'];

        $registers = [
            'x' => $x_Position,
            'y' => $y_Position,
            'registerId' => $registerId,
        ];


        $positionModel = $this->databaseManager->get('Position');
        $exitRegister = $positionModel->checkRegisterId($registerId);

        try {
            if ($exitRegister) {
                $positionModel->updatePosition($registers);
            } else {
                $positionModel->insertPosition($registers);
            }
            $data = ['success' => true,];
            header('Content-Type: application/json;');
            echo json_encode($data);
            if (!isset($_POST['test'])) {
                exit();
            }
        } catch (PDOException $e) {
            $this->heleper->handleError($e->getMessage());
        }
    }
}
