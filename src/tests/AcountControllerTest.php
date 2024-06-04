<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../controller/AcountController.php';
require_once __DIR__ . '/../models/User.php';


/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class AcountControllerTest extends TestCase
{
    protected $acountController;
    protected $application;
    protected $mysqli;
    protected $user;

    protected function setUp(): void
    {
        $db = [
            'hostname' => 'db',
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
            'database' => getenv('MYSQL_DATABASE'),
        ];
        $this->application = new Application($db);
        $this->mysqli = new mysqli('db', getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'));
        $this->user = new User($this->mysqli);
        $this->acountController = new AcountController($this->application);
    }

    protected function tearDown(): void
    {
        $this->mysqli->rollback();
        $this->acountController = null;
        $this->application = null;
        $this->mysqli = null;
        $this->user = null;
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndex()
    {
        //正常ルート
        $_POST['name'] = '開発者';
        $_POST['email'] = 'oredlllklkasdkjkjhkjjas@gmail.com';
        $_POST['password'] = 'razio';
        $_POST['password-confirm'] = 'razio';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        // $_SERVER['REQUEST_URI'] = '/acount';
        $action = 'index';
        $actual = $this->acountController->run($action);
        $this->assertStringContainsString('開発者', $actual);
        $this->user->delete($_POST['email']);
        //バリデーションに引っかかったルート
        $_POST['name'] = '開発';
        $_POST['email'] = 'oredlllklkasdkjkjhkjjas@gmail.com';
        $_POST['password'] = '';
        $_POST['password-confirm'] = '';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $actual = $this->acountController->run($action);
        $this->assertStringContainsString('パスワードを入力してください', $actual);
        $this->assertStringContainsString('確認用パスワードを入力してください', $actual);
    }
}
