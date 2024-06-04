<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../controller/PositionController.php';
require_once __DIR__ . '/../models/Position.php';
/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class PositionControllerTest extends TestCase
{
    protected $positionController;
    protected $application;
    protected $position;
    protected $mysqli;

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
        $this->positionController = new PositionController($this->application);
        $this->position = new Position($this->mysqli);
        $positions = [
            [
                'registerId' => 1,
                'x' => 100,
                'y' => 200,
            ],
            [
                'registerId' => 2,
                'x' => 300,
                'y' => 400,
            ]
        ];
        $this->position->insertPosition($positions[0]);
        $this->position->insertPosition($positions[1]);
    }
    protected function tearDown(): void
    {
        $this->position->deletePosition(1);
        $this->position->deletePosition(2);
        $this->positionController = null;
        $this->application = null;
        $this->mysqli = null;
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexWithValidDataForRegisterId1()
    {
        $_POST['x'] = 666;
        $_POST['y'] = 666;
        $_POST['register_id'] = 1;
        $_POST['test'] = true;
        $_SESSION['test_variable'] = 'test_value';
        $action = 'index';
        $this->positionController->run($action);
        $actual = $this->position->fetchPosition(1);
        $actual = [
            'x' => $actual['left_position'],
            'y' => $actual['top_position'],
        ];
        $expected =  [
            'x' => 666.0,
            'y' => 666.0,
        ];
        $this->assertSame($actual, $expected);
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexWithValidDataForRegisterId2()
    {
        $_POST['x'] = 555;
        $_POST['y'] = 555;
        $_POST['register_id'] = 2;
        $_POST['test'] = true;
        $_SESSION['test_variable'] = 'test_value';
        $action = 'index';
        $this->positionController->run($action);
        $actual = $this->position->fetchPosition(2);
        $actual = [
            'x' => $actual['left_position'],
            'y' => $actual['top_position'],
        ];
        $expected =  [
            'x' => 555.0,
            'y' => 555.0,
        ];
        $this->assertSame($actual, $expected);
    }
}
