<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/DatabaseManager.php';

/**
 * @covers summary
 */
class DatabaseManagerTest extends TestCase
{
    protected $databasemanager;

    protected function setUp(): void
    {
        $this->databasemanager = new DatabaseManager();
    }




    public function testConnect()
    {
        $this->databasemanager->connect(
            [
                'hostname' => 'db',
                'username' => 'test_user',
                'password' => 'pass',
                'database' => 'test_database',
            ]
        );

        // mysqli接続が成功していることを確認
        $this->assertInstanceOf(mysqli::class, $this->databasemanager->getMysqli());
    }

    // public function testGet()
    // {
    //     $this->databasemanager->connect(
    //         [
    //             'hostname' => 'db',
    //             'username' => 'test_user',
    //             'password' => 'pass',
    //             'database' => 'test_database',
    //         ]
    //     );
    //     $userModel = $this->databasemanager->get('User');

    //     $this->assertInstanceOf(User::class, $userModel);
    // }


    protected function tearDown(): void
    {
        $this->databasemanager = null;
    }
}
