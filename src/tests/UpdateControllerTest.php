<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../controller/UpdateController.php';
require_once __DIR__ . '/../models/Location.php';
require_once __DIR__ . '/../models/Register.php';
/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class UpdateControllerTest extends TestCase
{
    protected $updateController;
    protected $application;
    protected $search;
    protected $register;
    protected $location;
    protected $mysqli;
    protected $locationId;
    protected $registerId;

    protected function setUp(): void
    {
        parent::setUp();
        $db = [
            'hostname' => 'test_db',
            'username' => 'deveroper',
            'password' => 'pass',
            'database' => 'test_db',
        ];
        $this->application = new Application($db);
        $this->mysqli = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);
        $this->updateController = new UpdateController($this->application);
        $this->register = new Register($this->mysqli);
        $this->location = new Location($this->mysqli);
        $locations = [
            [
                'user_id' => 300,
                'location' => 'サンプル部屋',
                'file_name' => 'tmp.jpg',
                'save_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
            ],
            [
                'user_id' => 300,
                'location' => 'サンプルじゃない部屋',
                'file_name' => 'tmptmp.jpg',
                'save_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
            ],
            [
                'user_id' => 300,
                'location' => 'サンプルじゃない方の部屋',
                'file_name' => 'ore.jpg',
                'save_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
            ]
        ];
        foreach ($locations as $Key => $value) {
            $this->location->insert($value);
            $lastInsertId = $this->mysqli->insert_id;
            $locations[$Key]['location_id'] = $lastInsertId;
            $this->locationId[] = $lastInsertId;
        }
        $this->register = new Register($this->mysqli);
        $registers = [
            [
                'user_id' => 300,
                'location_id' => $locations[0]['location_id'],
                'name' => 'カップラーメン',
                'genre' => 'ジャンクフード',
                'other' => '味だけはいい',
                'price' => 200,
                'file_name' => 'sample.jpg',
                'file_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
            ],
            [
                'user_id' => 300,
                'location_id' => $locations[1]['location_id'],
                'name' => 'レコードプレイヤー',
                'genre' => '趣味',
                'price' => 30000,
                'other' => '高校生の時に購入',
                'file_name' => 'sample2.jpg',
                'file_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
            ],
            [
                'user_id' => 300,
                'location_id' => $locations[2]['location_id'],
                'name' => 'ギター',
                'genre' => '趣味',
                'price' => 3000000,
                'other' => '高校生の時に購入 バイト代で購入',
                'file_name' => 'sample3.jpg',
                'file_path' => '/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg',
            ]
        ];
        foreach ($registers as $Key => $value) {
            $this->register->insert($value);
            $lastInsertId = $this->mysqli->insert_id;
            $registers[$Key]['register_id'] = $lastInsertId;
            $this->registerId[] = $lastInsertId;
        }
    }
    protected function tearDown(): void
    {
        foreach ($this->registerId as $value) {
            $this->register->delete($value);
        }
        foreach ($this->locationId as $value) {
            $this->location->delete($value);
        }
        $this->updateController = null;
        $this->application = null;
        $this->search = null;
        $this->register = null;
        $this->location = null;
        $this->mysqli = null;
        $this->locationId = null;
        $this->registerId = null;
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndex()
    {
        session_start();
        $registers = [
            'カップラーメン',
            'レコードプレイヤー',
            'ギター',
        ];
        foreach ($this->registerId as $key => $value) {
            $_SESSION['loggedin'] = true;
            $_GET['id'] = $value;
            $action = 'index';
            $actual = $this->updateController->run($action);
            $this->assertStringContainsString($registers[$key], $actual);
        }
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testReturn()
    {
        session_start();
        $_SESSION['login_user'] = [
            'id' => 300,
            'name' => '五条悟',
            'email' => 'oreore@gmail.com',
            'password' => 'oreoreoo',
        ];
        $locations = [
            'サンプル部屋',
            'サンプルじゃない部屋',
            'サンプルじゃない方の部屋',
        ];
        $_SESSION['loggedin'] = true;
        $_GET['location_id'] = $this->locationId[2];
        $action = 'return';
        $actual = $this->updateController->run($action);
        $this->assertStringContainsString($locations[2], $actual);
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testReturn2()
    {
        session_start();
        $_SESSION['login_user'] = [
            'id' => 300,
            'name' => '五条悟',
            'email' => 'oreore@gmail.com',
            'password' => 'oreoreoo',
        ];
        $locations = [
            'サンプル部屋',
            'サンプルじゃない部屋',
            'サンプルじゃない方の部屋',
        ];
        $_SESSION['loggedin'] = true;
        $_GET['location_id'] = $this->locationId[1];
        $action = 'return';
        $actual = $this->updateController->run($action);
        $this->assertStringContainsString($locations[1], $actual);
    }
}
