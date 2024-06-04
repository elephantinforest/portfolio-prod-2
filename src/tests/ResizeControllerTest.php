<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../controller/ResizeController.php';
require_once __DIR__ . '/../models/Resize.php';
/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class ResizeControllerTest extends TestCase
{
    protected $resizeController;
    protected $application;
    protected $resize;
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
        $this->resizeController = new ResizeController($this->application);
        $this->resize = new Resize($this->mysqli);
        $resizes = [
            [
                'registerId' => 1,
                'width' => 100,
                'height' => 200,
            ],
            [
                'registerId' => 2,
                'width' => 300,
                'height' => 400,
            ]
        ];
        $this->resize->insert($resizes[0]);
        $this->resize->insert($resizes[1]);
    }
    protected function tearDown(): void
    {
        $this->resize->delete(1);
        $this->resize->delete(2);
        $this->resizeController = null;
        $this->application = null;
        $this->mysqli = null;
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexWithValidDataForRegisterId1()
    {
        session_start();
        $_POST['data'] = [
            'registerId' => 1,
            'width' => 555,
            'height' => 555,
        ];
        $_POST['test'] = true;
        $_SESSION['loggedin'] = true;
        $action = 'index';
        $this->resizeController->run($action);
        $actual = $this->resize->fetchResize(1);
        $actual = [
            'width' => $actual['width'],
            'height' => $actual['height'],
        ];
        $expected =  [
            'width' => 555,
            'height' => 555,
        ];
        $this->assertSame($actual, $expected);
    }
    /**
     * @covers DefaultClass::method
     * @runInSeparateProcess
     */
    public function testIndexInsert()
    {
        session_start();
        $_POST['data'] = [
            'registerId' => 3,
            'width' => 666,
            'height' => 666,
        ];
        $_POST['test'] = true;
        $_SESSION['loggedin'] = true;
        $action = 'index';
        $this->resizeController->run($action);
        $actual = $this->resize->fetchResize(3);
        $actual = [
            'width' => $actual['width'],
            'height' => $actual['height'],
        ];
        $expected =  [
            'width' => 666,
            'height' => 666,
        ];
        $this->assertSame($actual, $expected);
        $this->resize->delete(3);
    }
}
