<?php
class LocationsController extends Controller
{
    public function index(): void
    {
        /**
         * ロケーションを登録する
         *
         * @return type json
         */
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //ポストされたファイルの取得
        $user_id = $_SESSION['login_user']['id'];
        $location = $_POST['location'];
        $files = $_FILES['image'];
        $fileName = basename($files['name']);
        //日付などをつけてユニークはパス名を作る
        $savePath = $this->heleper->crateLocationSaveFile($fileName);
        $files['savePath'] = $savePath;
        //バリデーション処理
        $locationModel = $this->databaseManager->get('Location');
        $locationErrors = $this->validation->locationValidation($location, $user_id, $locationModel);
        $fileErrors = $this->validation->fileValidation($files);
        //エラー無かったらDBに登録してブラウザにJSONを返す
        if (empty($locationErrors) && empty($fileErrors)) {
            try {
                //配列にまとめる
                $locations = [
                    'user_id' => $user_id,
                    'location' => $location,
                    'file_name' => $fileName,
                    'save_path' => $savePath,
                ];
                //ロケーションテーブルにレコード作成
                $locationModel->insert($locations);
                //画像ファイルエンコード
                $savePath = $this->heleper->createPath($savePath);
                //インサートしたロケーションIDの取得
                $locationId = $locationModel->getInsertId();
                //ブラウザに返すJSON
                $data = ['success' => true, 'imageUrl' => $savePath, 'locationValue' => $location, 'locationId' => $locationId];
                $this->heleper->sendResponse($data);
            } catch (PDOException $e) {
                $this->heleper->handleError($e->getMessage());
            }
        } else {
            $errors = array_merge($locationErrors, $fileErrors);
            $this->heleper->handleError($errors);
        }
    }
    public function return()
    {
        /**
         * ユーザーIDに紐づくロケーションを取得する
         *
         * @return type json
         */
        if ($this->request->isPost()) {
            return $this->render([
                'title' => '所持品の登録',
                'errors' => [],
            ]);
        }
        session_start();
        $status = $_SERVER['REDIRECT_URL'];
        $user_id = $_SESSION['login_user']['id'];
        $locationId = $_GET['locationId'];
        $locationModel = $this->databaseManager->get('Location');
        $registerModel = $this->databaseManager->get('Register');
        if ($status === '/prev') {
            try {
                $location = $locationModel->prevReturn($locationId, $user_id);
                if (empty($location)) {
                    $this->heleper->handleError('それ以上クリックはできません。');
                }
                $location = $location[0];
                $locationId = $location['location_id'];
                $registers = $registerModel->fetchLocationRegister($user_id, $locationId);
                if (!empty($registers)) {
                    foreach ($registers as $num => $register) {
                        foreach ($register as $key => $value) {
                            if ($key == 'file_path') {
                                $registers[$num]['file_path'] = $this->heleper->createPath($value);
                            }
                        }
                    }
                }
                $location['file_path'] = $this->heleper->createPath($location['file_path']);
                $data = ['success' => true, 'locations' => $location, 'registers' => $registers];
                $this->heleper->sendResponse($data);
            } catch (PDOException $e) {
                $this->heleper->handleError($e->getMessage());
            }
        } else {
            try {
                $location = $locationModel->nextReturn($locationId, $user_id);
                if (empty($location)) {
                    $this->heleper->handleError('それ以上クリックはできません。');
                }
                $location = $location[0];
                $locationId = $location['location_id'];
                $registers = $registerModel->fetchLocationRegister($user_id, $locationId);
                if (!empty($registers)) {
                    foreach ($registers as $num => $register) {
                        foreach ($register as $key => $value) {
                            if ($key == 'file_path') {
                                $registers[$num]['file_path'] = $this->heleper->createPath($value);
                            }
                        }
                    }
                }
                $location['file_path'] = $this->heleper->createPath($location['file_path']);
                $data = ['success' => true, 'locations' => $location, 'registers' => $registers];
                $this->heleper->sendResponse($data);
            } catch (PDOException $e) {
                $this->heleper->handleError($e->getMessage());
            }
        }
    }
}
