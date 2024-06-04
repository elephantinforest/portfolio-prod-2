<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../controller/LoginController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Location.php';
require_once __DIR__ . '/../models/Register.php';
require_once __DIR__ . '/../models/Resize.php';
require_once __DIR__ . '/../models/Position.php';


/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class LoginControllerTest extends TestCase
{
    protected $loginController;
    protected $application;
    protected $user;
    protected $location;
    protected $register;
    protected $resize;
    protected $position;
    protected $mysqli;
    protected $userId;

    protected function setUp(): void
    {
        $db = [
            'hostname' => 'test_db',
            'username' => 'deveroper',
            'password' => 'pass',
            'database' => 'test_db',
        ];
        $this->application = new Application($db);
        $this->mysqli = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);
        // $this->user = new User($this->mysqli);
        $this->loginController = new LoginController($this->application);
        $this->mysqli->begin_transaction();
        $this->user = new User($this->mysqli);
        $user = [
            'name' => '五条悟',
            'email' => 'uoreore@gmail.com',
            'password' => password_hash('oreoreoo', PASSWORD_DEFAULT),
        ];
        $this->user->insert($user['name'], $user['email'], $user['password']);
        $userId = $this->user->getInsertId();
        $this->userId = $userId;
        $this->mysqli->commit();
    }

    protected function tearDown(): void
    {
        $this->mysqli->rollback();
        $this->loginController = null;
        $this->application = null;
        $this->mysqli = null;
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndex()
    {
        session_start();
        $_POST['email'] = 'uoreore@gmail.com';
        $_POST['password'] = 'oreoreoo';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        // セッションに値を設定
        $_SESSION['login_user']['id'] = 1;
        $action = 'index';
        $actual = $this->loginController->run($action);
        $expected = 'ロケーションは登録されていません。';
        $this->assertStringContainsString($expected, $actual);
        $this->user->delete('uoreore@gmail.com');
        session_destroy();
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexLoginUser()
    {
        $this->location = new Location($this->mysqli);
        $locations = [

            'user_id' => $this->userId,
            'location' => 'サンプル部屋',
            'file_name' => 'tmp.jpg',
            'save_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
        ];
        $this->location->insert($locations);
        $locationId = $this->location->getInsertId();
        $this->register = new Register($this->mysqli);
        $registers = [
            [
                'user_id' => $this->userId,
                'location_id' => $locationId,
                'name' => 'カップラーメン',
                'genre' => 'ジャンクフード',
                'other' => '味だけはいい',
                'price' => 200,
                'file_name' => 'sample.jpg',
                'file_path' => '/var/www/html/src/imgs/_d1e286cd-fbbe-45a6-8823-730f39979c08.jpg',
            ],
            [
                'user_id' => $this->userId,
                'location_id' => $locationId,
                'name' => 'レコードプレイヤー',
                'genre' => '趣味',
                'price' => 30000,
                'other' => '高校生の時に購入',
                'file_name' => 'sample2.jpg',
                'file_path' => '/var/www/html/src/imgs/_d1e286cd-fbbe-45a6-8823-730f39979c08.jpg',
            ]
        ];
        foreach ($registers as $Key => $value) {
            $this->register->insert($value);
            $lastInsertId = $this->mysqli->insert_id;
            $registers[$Key]['register_id'] = $lastInsertId;
        }

        $this->resize = new Resize($this->mysqli);
        $resizes = [
            [
                'registerId' => $registers[0]['register_id'],
                'width' => 100,
                'height' => 200,
            ],
            [
                'registerId' => $registers[1]['register_id'],
                'width' => 300,
                'height' => 400,
            ]
        ];
        $this->resize->insert($resizes[0]);
        $this->resize->insert($resizes[1]);

        $this->position = new Position($this->mysqli);
        $positions = [
            [
                'registerId' => $registers[0]['register_id'],
                'x' => 100,
                'y' => 200,
            ],
            [
                'registerId' => $registers[1]['register_id'],
                'x' => 300,
                'y' => 400,
            ]
        ];
        $this->position->insertPosition($positions[0]);
        $this->position->insertPosition($positions[1]);
        session_start();

        $_POST['email'] = 'uoreore@gmail.com';
        $_POST['password'] = 'oreoreoo';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        // セッションに値を設定
        $_SESSION['loggedin'] = true;
        $_SESSION['login_user']['id'] = 300;
        $_SESSION['login_user']['name'] = '名無しの権兵衛';
        $action = 'index';
        $actual = $this->loginController->run($action);
        $expected = [
            '名無しの権兵衛',
        ];
        foreach ($expected as $value) {
            $this->assertStringContainsString($value, $actual);
        };
        // $this->assertStringContainsString($expected, $actual);
        $this->user->delete('uoreore@gmail.com');
        $this->location->delete($locationId);
        $this->resize->delete($registers[0]['register_id']);
        $this->resize->delete($registers[1]['register_id']);
        $this->register->delete($registers[0]['register_id']);
        $this->register->delete($registers[1]['register_id']);
        $this->position->deletePosition($registers[0]['register_id']);
        $this->position->deletePosition($registers[1]['register_id']);
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexUser()
    {
        $this->location = new Location($this->mysqli);
        $locations = [

            'user_id' => $this->userId,
            'location' => 'サンプル部屋',
            'file_name' => 'tmp.jpg',
            'save_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
        ];
        $this->location->insert($locations);
        $locationId = $this->location->getInsertId();
        $this->register = new Register($this->mysqli);
        $registers = [
            [
                'user_id' => $this->userId,
                'location_id' => $locationId,
                'name' => 'カップラーメン',
                'genre' => 'ジャンクフード',
                'other' => '味だけはいい',
                'price' => 200,
                'file_name' => 'sample.jpg',
                'file_path' => '/var/www/html/src/imgs/_d1e286cd-fbbe-45a6-8823-730f39979c08.jpg',
            ],
            [
                'user_id' => $this->userId,
                'location_id' => $locationId,
                'name' => 'レコードプレイヤー',
                'genre' => '趣味',
                'price' => 30000,
                'other' => '高校生の時に購入',
                'file_name' => 'sample2.jpg',
                'file_path' => '/var/www/html/src/imgs/_d1e286cd-fbbe-45a6-8823-730f39979c08.jpg',
            ]
        ];
        foreach ($registers as $Key => $value) {
            $this->register->insert($value);
            $lastInsertId = $this->mysqli->insert_id;
            $registers[$Key]['register_id'] = $lastInsertId;
        }

        $this->resize = new Resize($this->mysqli);
        $resizes = [
            [
                'registerId' => $registers[0]['register_id'],
                'width' => 100,
                'height' => 200,
            ],
            [
                'registerId' => $registers[1]['register_id'],
                'width' => 300,
                'height' => 400,
            ]
        ];
        $this->resize->insert($resizes[0]);
        $this->resize->insert($resizes[1]);

        $this->position = new Position($this->mysqli);
        $positions = [
            [
                'registerId' => $registers[0]['register_id'],
                'x' => 100,
                'y' => 200,
            ],
            [
                'registerId' => $registers[1]['register_id'],
                'x' => 300,
                'y' => 400,
            ]
        ];
        $this->position->insertPosition($positions[0]);
        $this->position->insertPosition($positions[1]);
        session_start();

        $_POST['email'] = 'uoreore@gmail.com';
        $_POST['password'] = 'oreoreoo';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        // セッションに値を設定
        $_SESSION['login_user']['id'] = 300;
        $_SESSION['login_user']['name'] = '名無しの権兵衛';
        $action = 'index';
        $actual = $this->loginController->run($action);
        $expected = [
            '五条悟',
        ];
        foreach ($expected as $value) {
            $this->assertStringContainsString($value, $actual);
        };
        // $this->assertStringContainsString($expected, $actual);
        $this->user->delete('uoreore@gmail.com');
        $this->location->delete($locationId);
        $this->resize->delete($registers[0]['register_id']);
        $this->resize->delete($registers[1]['register_id']);
        $this->register->delete($registers[0]['register_id']);
        $this->register->delete($registers[1]['register_id']);
        $this->position->deletePosition($registers[0]['register_id']);
        $this->position->deletePosition($registers[1]['register_id']);
    }

    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexFailedUser()
    {

        $_POST['email'] = 'ueore@gmail.com';
        $_POST['password'] = 'orreoo';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        // セッションに値を設定
        $action = 'index';
        $actual = $this->loginController->run($action);
        $expected = [
            'メールアドレスとパスワードが一致しませんでした。ログインならず、、、',
        ];
        foreach ($expected as $value) {
            $this->assertStringContainsString($value, $actual);
        };
        $this->user->delete('uoreore@gmail.com');
    }
}
