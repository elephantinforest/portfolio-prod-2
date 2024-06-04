<?php

class SearchController extends Controller
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
    try {
      $userId = $_SESSION['login_user']['id'];
      $string = "%{$_GET['search']}%";
      $searchModel = $this->databaseManager->get('Search');
      $registers = $searchModel->searchRegisters($userId, $string);
      $user = $_SESSION['login_user'];
      $searchWord = $_GET['search'];
      $count = count($registers);
      return $this->render(
        [
          'title' => 'ユーザーのログイン',
          'registers' => $registers,
          'user' => $user,
          'word' => $searchWord,
          'count' => $count,
        ],
        'index',
        'layout_less'
      );
    } catch (PDOException $e) {
      $this->heleper->handleError($e->getMessage());
    }
  }
}
