<?php

class DeleteController extends Controller
{
  /**
   * registerアイテムの削除
   *
   * @return type null;
   */
  public function delete()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    if (!$_SESSION['loggedin']) {
      throw new PDOException('ログインしてください');
    }
    try {
      $registerId = $_POST['register_id'];
      $positionModel = $this->databaseManager->get('Position');
      $registerModel = $this->databaseManager->get('Register');
      $resizeModel = $this->databaseManager->get('Resize');
      $positionModel->deletePosition($registerId);
      $registerModel->delete($registerId);
      $resizeModel->delete($registerId);
      $data = ['success' => true, 'registerId' => $registerId];
      if(isset($_POST['test'])) {
        $this->heleper->isTestTrue();
      }
      $this->heleper->sendResponse($data);
    } catch (PDOException $e) {
      $this->heleper->handleError($e->getMessage());
    }
  }
}
