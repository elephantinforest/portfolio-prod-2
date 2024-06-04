<?php

class ResizeController extends Controller
{
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
    $data = $_POST['data'];
    $resizeModel = $this->databaseManager->get('Resize');
    $registerId = $data['registerId'];
    $existID = $resizeModel->existId($registerId);
    if (isset($_POST['test'])) {
      $this->heleper->isTestTrue();
    }
    if ($existID) {
      try {
        $resizeModel->update($data);
        $data = [
          'succes' => true
        ];
        $this->heleper->sendResponse($data);
      } catch (PDOException $e) {
        $this->heleper->handleError($e->getMessage());
      }
    } else {
      try {
        $resizeModel->insert($data);
        $data = [
          'succes' => true
        ];
        $this->heleper->sendResponse($data);
      } catch (PDOException $e) {
        $this->heleper->handleError($e->getMessage());
      }
    }
  }
}
