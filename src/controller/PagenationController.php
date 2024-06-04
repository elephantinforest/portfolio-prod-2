<?php

class PagenationController extends Controller
{


  public function index()
  {

    session_start();

    if (!$_SESSION['loggedin']) {
      return $this->render([
        'title' => '所持品の登録',
        'errors' => [
          "ログインしないとはいれないで！しょうもないことすな"
        ],
      ], 'login');
    }

    $userId = $_SESSION['login_user']['id'];
    $locationId = $_POST['location_id'];

    $registerModel = $this->databaseManager->get('Register');
    $registersName = $registerModel->fetchPagenation($userId, $locationId);
    $registersName =  json_encode($registersName, JSON_UNESCAPED_UNICODE);
    $data = ['success' => true, 'registersName' => $registersName];
    header('Content-Type: application/json;');
    echo json_encode($data);
    exit();
  }
}
