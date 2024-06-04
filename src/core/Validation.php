<?php

class Validation
{
    public function userValidation(array $user): array
    {
        $errors = [];

        $userexist = $user['usermodel']->fetchUser($user['email']);

        if (empty($user['name'])) {
            $errors['name'] = 'ユーザー名を入力してください';
        } elseif (mb_strlen($user['name'], 'UTF-8') < 1) {
            $errors['name'] = 'ユーザー名は1文字以上で入力してください';
        } elseif (strlen($user['name']) > 100) {
            $errors['name'] = 'ユーザー名は100文字以内で入力してください';
        }

        if (empty($user['email'])) {
            $errors['email'] = 'メールアドレスを入力してください';
        } elseif (strlen($user['email']) > 255) {
            $errors['email'] = 'メールアドレスは255文字以内で入力してください';
        } elseif (!empty($userexist)) {
            $errors['model'] = 'メールアドレスが重複しています';
        }

        if (empty($user['password'])) {
            $errors['password'] = 'パスワードを入力してください';
        } elseif (strlen($user['password']) > 100) {
            $errors['password'] = 'パスワードは100文字以内で入力してください';
        }

        if (empty($user['passwordConfirm'])) {
            $errors['passwordConfirm'] = '確認用パスワードを入力してください';
        } elseif (strlen($user['password']) > 100) {
            $errors['passwordConfirm'] = 'パスワードを間違えています';
        }
        if ($user['passwordConfirm'] !== $user['password']) {
            $errors['password'] = '確認用パスワードの値が違う値です。';
        }


        return $errors;
    }


    public function fileValidation(array $files): array
    {
        $errors = [];

        if ($files['size'] > 16485760 || $files['error'] === 2) {
            $errors['size'] = "ファイルサイズは15MB以内でよろしくお願いします。";
        }

        //拡張子は画像形式か？

        $allow_ext = ['jpg', 'jpeg', 'png'];
        $file_ext = pathinfo($files['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_ext), $allow_ext)) {
            $errors['fileName'] = "画像ファイルを添付してください";
        }

        //ファイルはあるかどうか？
        if (!is_uploaded_file($files['tmp_name'])) {
            $errors["tmpfile"] = "ファイルが選択されていません。";
        }
        if (!move_uploaded_file($files['tmp_name'], $files['savePath'])) {
            $errors['move'] = "ファイルの移動に失敗しました。";
        }

        return $errors;
    }

    public function loginValidation(array $user): array
    {
        $errors = [];

        if (empty($user['email'])) {
            $errors['email'] = 'メールアドレスを入力してください';
        } elseif (strlen($user['email']) > 255) {
            $errors['email'] = 'メールアドレスは255文字以内で入力してください';
        } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '有効なメールアドレスを入力してください';
        }

        if (empty($user['password'])) {
            $errors['password'] = 'パスワードを入力してください';
        } elseif (strlen($user['password']) > 100) {
            $errors['password'] = 'パスワードは100文字以内で入力してください';
        }

        return $errors;
    }
 
    public function locationValidation(string $location, string $userId, Location $locationModel): array
    {
        $errors = [];

        $existLocation = $locationModel->existLocation($userId, $location);

        if (empty($location)) {
            $errors['location'] = 'ロケーション名を入力してください';
        } elseif (!empty($existLocation)) {
            $errors['location'] = 'ロケーション名が重複しています。';
        }
        return $errors;
    }

    function validateRegister(array $register): array
    {
        $errors = [];

        // 名前のバリデーション
        if (!isset($register['name']) || empty($register['name'])) {
            $errors[] = "名前を入力してください。";
        } elseif (strlen($register['name']) > 255) {
            $errors[] = "名前は255文字以内で入力してください。";
        }

        // ジャンルのバリデーション
        if (!isset($register['genre']) || empty($register['genre'])) {
            $errors[] = "ジャンルを入力してください。";
        } elseif (strlen($register['genre']) > 255) {
            $errors[] = "ジャンルは255文字以内で入力してください。";
        }

        // 価格のバリデーション
        if (!isset($register['price']) || !is_numeric($register['price']) || $register['price'] < 0) {
            $errors[] = "価格は正の数値で入力してください。";
        }

        // メモのバリデーション
        if (isset($register['other']) && strlen($register['other']) > 255) {
            $errors[] = "メモは255文字以内で入力してください。";
        }

        return $errors;
    }
}
