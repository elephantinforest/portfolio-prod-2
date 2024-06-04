<?php

class LogoutController extends Controller
{
  public function index(): string
  {
    $errors = [];
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    // if (!$_SESSION['loggedin']) {
    //   session_destroy();

    //   return $this->render([
    //     'title' => '所持品の登録',
    //     'errors' => [
    //       'message' => "ログインしな!"
    //     ],'index','less'
    //   ]);
    // }

    session_destroy();
    return $this->render(
      [
        'title' => 'ユーザーのログイン',
        // 'user' => $user,
        'errors' => $errors,
      ],'index', 'less'
    );
  }
}
