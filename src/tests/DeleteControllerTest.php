<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../controller/DeleteController.php';
require_once __DIR__ . '/../models/Position.php';
require_once __DIR__ . '/../models/Register.php';
require_once __DIR__ . '/../models/Resize.php';


/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class DeleteControllerTest extends TestCase
{
    protected $deleteController;
    protected $delete;
    protected $application;
    protected $mysqli;
    protected $position;
    protected $register;
    protected $resize;

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
        $this->position = new Position($this->mysqli);
        $this->register = new Register($this->mysqli);
        $this->resize = new Resize($this->mysqli);
        $this->deleteController = new DeleteController($this->application);

        // セッションを開始
        session_start();

        // セッションに値を設定
        $_SESSION['loggedin'] = true;
    }

    protected function tearDown(): void
    {
        $this->mysqli->rollback();
        $this->deleteController = null;
        $this->delete = null;
        $this->application = null;
        $this->mysqli = null;
        $this->position = null;
        $this->register = null;
        $this->resize = null;
        // セッションをクリア
        $_SESSION = [];

        parent::tearDown();
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testDelete()
    {
        $registers = [
            [
                'user_id' => 300,
                'location_id' => 100,
                'name' => 'カップラーメン',
                'genre' => 'ジャンクフード',
                'other' => '味だけはいい',
                'price' => 200,
                'file_name' => 'sample.jpg',
                'file_path' => 'src/imgs/sample.jpg',
            ],
            [
                'user_id' => 300,
                'location_id' => 100,
                'name' => 'レコードプレイヤー',
                'genre' => '趣味',
                'price' => 30000,
                'other' => '高校生の時に購入',
                'file_name' => 'sample2.jpg',
                'file_path' => 'src/imgs/sample2.jpg',
            ]
        ];

        foreach ($registers as $Key => $value) {
            $this->register->insert($value);
            $lastInsertId = $this->mysqli->insert_id;
            $registers[$Key]['register_id'] = $lastInsertId;
        }


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
        $this->mysqli->commit();

        $_POST['register_id'] = $registers[0]['register_id'];
        $_POST['test'] = true;
        $action = 'delete';
        $this->deleteController->run($action);
        $_POST['register_id'] = $registers[1]['register_id'];
        $this->deleteController->run($action);
        $result1 = $this->register->fetchRegister($registers[0]['register_id']);
        $result2 = $this->register->fetchRegister($registers[1]['register_id']);

        $this->assertEmpty($result1);
        $this->assertEmpty($result2);
    }
}
