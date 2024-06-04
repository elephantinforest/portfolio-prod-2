<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Application.php';
require_once __DIR__ . '/../controller/LogoutController.php';
/**
 * @covers DefaultClass::method
 * @runInSeparateProcess
 */
class LogoutControllerTest extends TestCase
{
    protected $logoutController;
    protected $application;
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
        $this->logoutController = new LogoutController($this->application);
    }
    protected function tearDown(): void
    {

        $this->logoutController = null;
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
        $_SESSION['test_variable'] = 'test_value';
        $action = 'index';
        $this->logoutController->run($action);
        session_start();
        $this->assertArrayNotHasKey('test_variable', $_SESSION);
        session_destroy();
    }
}
