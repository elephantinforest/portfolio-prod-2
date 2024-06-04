<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../controller/RegisterController.php';
require_once __DIR__ . '/../models/Register.php';
require_once __DIR__ . '/../models/Position.php';
/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class RegisterControllerTest extends TestCase
{
    protected $registerController;
    protected $application;
    protected $register;
    protected $position;
    protected $mysqli;
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
        $this->mysqli->begin_transaction();
        $this->registerController = new RegisterController($this->application);
        $this->register = new Register($this->mysqli);
        $registers = [
            [
                'user_id' => 1,
                'location_id' => 1,
                'name' => 'カップラーメン',
                'genre' => 'ジャンクフード',
                'other' => '味だけはいい',
                'price' => 200,
                'file_name' => 'sample.jpg',
                'file_path' => '/var/www/html/src/imgs/_d1e286cd-fbbe-45a6-8823-730f39979c08.jpg',
            ],
            [
                'user_id' => 1,
                'location_id' => 1,
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
            $this->registerId[] = $lastInsertId;
        }

        $this->position = new Position($this->mysqli);
        $positions = [
            [
                'registerId' => $registers[1]['register_id'],
                'x' => 300,
                'y' => 400,
            ]
        ];
        $this->position->insertPosition($positions[0]);
        $this->mysqli->commit();
    }
    protected function tearDown(): void
    {
        foreach ($this->registerId as $value) {
            $this->register->delete($value);
        }
        $this->position->deletePosition($this->registerId[1]);
        $this->registerController = null;
        $this->application = null;
        $this->position = null;
        $this->mysqli = null;
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testUpdate()
    {
        $_POST['registerId'] = $this->registerId[0];
        $_POST['locationId'] = 1;
        $_POST['x'] = 666;
        $_POST['y'] = 666;
        $_POST['test'] = true;
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $action = 'update';
        $this->registerController->run($action);
        $actual = $this->position->fetchPosition($this->registerId[0]);
        $actual = [
            'registerId' => $actual['register_id'],
            'x' => $actual['left_position'],
            'y' => $actual['top_position'],
        ];
        $expected =
        [
            'registerId' => $this->registerId[0],
            'x' => 666.0,
            'y' => 666.0,
        ];
        $this->assertSame($actual, $expected);
        $this->position->deletePosition($this->registerId[0]);
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testPosition()
    {
        $_POST['register_id'] = $this->registerId[1];
        $_POST['x'] = 555;
        $_POST['y'] = 555;
        $_POST['test'] = true;
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $action = 'position';
        $this->registerController->run($action);
        $actual = $this->position->fetchPosition($this->registerId[1]);
        $actual = [
            'registerId' => $actual['register_id'],
            'x' => $actual['left_position'],
            'y' => $actual['top_position'],
        ];
        $expected =
            [
                'registerId' => $this->registerId[1],
                'x' => 555.0,
                'y' => 555.0,
            ];
        $this->assertSame($actual, $expected);
    }
}
