<?php

class UpdateController extends Controller
{

  //アップデート画面を表示する処理
  public function index()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    if (!$_SESSION['loggedin']) {
      return $this->render([
        'title' => '所持品の登録',
        'errors' => [
          "ログインしないとはいれないで！しょうもないことすな"
        ],
      ], 'login');
    }
    $registerId = $_GET['id'];
    try {
      $registerModel = $this->databaseManager->get('Register');
      $register = $registerModel->fetchUpdateRegister($registerId);
    } catch (PDOException $e) {
      $this->heleper->handleError($e->getMessage());
    }
    return $this->render(
      [
        'title' => 'ユーザーのログイン',
        'register' => $register,
      ],
      'index',
      'layout_less'
    );
  }
  //レジスターアイテムのアップデート処理
  public function update()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    if (!$_SESSION['loggedin']) {
      return $this->render([
        'title' => '所持品の登録',
        'errors' => [
          "ログインしないとはいれないで！しょうもないことすな"
        ],
      ], 'login');
    } elseif (!$this->request->isPost()) {
      $response = new Response();
      $error = new HttpNotFoundException();
      $error->render404Page($response);
      $response->send();
      exit();
    }
    $register = $_POST;
    $files = $_FILES['image_file'];
    $fileName = basename($_FILES['image_file']['name']);
    $savePath = $this->heleper->crateRegisterSaveFile($fileName);
    $files['savePath'] = $savePath;
    //POSTされた値のバリデーション
    $registerErrors = $this->validation->validateRegister($register);
    $fileErrors = $this->validation->filevalidation($files);
    //アップデート終了後のリダイレクト先のパス
    $path = "Location: http://localhost:5008/update?location_id={$register['location_id']}";
    if (empty($fileErrors)) {
      //ファイルバリデーション通過した処理
      if (empty($registerErrors)) {
        //レジスターバリデーション通過した処理
        try {
          $register['file_path'] = $savePath;
          $register['file_name'] = $fileName;
          $registerModel = $this->databaseManager->get('Register');
          $registerModel->updateRegister($register);
          header($path);
          exit;
        } catch (PDOException $e) {
          $this->heleper->handleError($e->getMessage());
        }
      } else {
        $errors = array_merge($registerErrors, $fileErrors);
        return $this->render(
          [
            'errors' => $errors,
            'register' => $register,
            'files' => $files
          ],
          'index',
          'layout_less'
        );
      }
    } //ファイルバリデーション通過しなかった処理
    else {
      if (empty($registerErrors)) {
        //レジスターバリデーション通過した処理
        try {
          $register['file_path'] = NULL;
          $register['file_name'] = NULL;
          /** @var Register $registerModel */
          $registerModel = $this->databaseManager->get('Register');
          $registerModel->updateRegister($register);
          header($path);
          exit;
        } catch (PDOException $e) {
          $this->heleper->handleError($e->getMessage());
        }
      } //レジスターバリデーションが通過できなかった処理　アップデート画面に返す
      else {
        $errors = array_merge($registerErrors, $fileErrors);
        return $this->render(
          [
            'errors' => $errors,
            'register' => $register,
            'files' => $files
          ],
          'index',
          'layout_less'
        );
      }
    }
  }
  //アップデート画面から戻るボタンを押したときにメインページに戻る処理
  public function return()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    if (!$_SESSION['loggedin']) {
      return $this->render([
        'title' => '所持品の登録',
        'errors' => [
          "ログインしないとはいれないで！しょうもないことすな"
        ],
      ], 'login');
    }
    $locationId = (int)$_GET['location_id'];
    $userId = $_SESSION['login_user']['id'];
    $user = $_SESSION['login_user'];
    try {
      $registerModel = $this->databaseManager->get('Register');
      $locationModel = $this->databaseManager->get('Location');
      $registers = $registerModel->fetchLocationRegister($userId, $locationId);
      $location = $locationModel->fetchUpdateLocation($locationId);
    } catch (PDOException $e) {
      $this->heleper->handleError($e->getMessage());
    }
    return $this->render(
      [
        'title' => 'ユーザーのログイン',
        'registers' => $registers,
        'locations' => $location,
        'user' => $user,
      ],
      'user'
    );
  }
}
