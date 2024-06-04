<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/Validation.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Location.php';

/**
 * @covers summary
 */
class ValidationTest extends TestCase
{
    protected $validation;

    protected function setUp(): void
    {
        $this->validation = new Validation();
    }

    public function testUserValidation()
    {
        // モックの作成
        $stub = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['fetch'])
            ->getMock();

        // fetch メソッドが呼び出された場合の返り値を設定
        $stub->method('fetch')
            ->willReturnCallback(function ($query, $params) {
                // メールアドレスが 'test@example.com' の場合はユーザー情報を返す
                if ($query === "SELECT * FROM users WHERE email =?" && $params === ['s', 'taro@example.com']) {
                    return [['id' => 1, 'email' => 'test@example.com', 'name' => 'Test User']];
                } else {
                    // それ以外の場合は空の配列を返す（ユーザーが見つからない場合）
                    return [];
                }
            });

        $user = [
            'name' => '田中太郎',
            'email' => 'taro@example.com',
            'password' => 'password123',
            'passwordConfirm' => 'password123',
            'usermodel' => $stub
        ];
        $errors = $this->validation->userValidation($user);
        $this->assertEquals('メールアドレスが重複しています', $errors['model']); // 正しいエラーメッセージが返されているか
        $user = [
            'name' => '田中太郎',
            'email' => 'tao@example.com',
            'password' => 'password123',
            'passwordConfirm' => 'password123',
            'usermodel' => $stub
        ];
        $errors = $this->validation->userValidation($user);
        // $this->assertEquals('メールアドレスが重複しています', $errors['model']); // 正しいエラーメッセージが返されているか
        $this->assertEmpty($errors);
    }

    public function testFileValidation()
    {
        $files = [
            'size' => 1500333,
            'error' => 0,
            'name' => 'example.jpg',
            'tmp_name' => '/tmp/tmpfile.txt', // テスト用の一時ファイルを指定
            'savePath' => '/path/to/save/file.txt'
        ];
        $errors = $this->validation->fileValidation($files);
        $errors = array_filter($errors, function ($key) {
            return $key != 'tmpfile' && $key != 'move'; // 'tmpfile' または 'move' でないキーを残す
        }, ARRAY_FILTER_USE_KEY);

       $this->assertEmpty($errors);
    }


    public function testLoginValidation()
    {
        $user = [
            'email' => 'taro@example.com',
            'password' => 'password123'
        ];

        $errors = $this->validation->loginValidation($user);
        $this->assertEmpty($errors);
    }

    public function testLocationValidation()
    {
        // モックの作成
        $locationModelMock = $this->getMockBuilder(Location::class)
            ->disableOriginalConstructor()
            ->getMock();

        // existLocation メソッドが呼び出された際の戻り値を設定
        $userId = 123; // ユーザーID
        $location = 'Tokyo'; // ロケーション
        $existLocationResult = false; // 存在するとする
        $locationModelMock->expects($this->once()) // 1回だけメソッドが呼ばれることを期待
            ->method('existLocation')
            ->with($this->equalTo($userId), $this->equalTo($location))
            ->willReturn($existLocationResult);


        $errors = $this->validation->locationValidation($location, $userId, $locationModelMock);
        $this->assertEmpty($errors);
    }

    public function testValidateRegister()
    {
        $registers = [
            'name' => 'サンプル商品',
            'genre' => 'サンプルジャンル',
            'price' => 1000,
            'other' => 'サンプルメモ'
        ];

        $errors = $this->validation->validateRegister($registers);
        $this->assertEmpty($errors);
    }

    protected function tearDown(): void
    {
        $this->validation = null;
    }
}
