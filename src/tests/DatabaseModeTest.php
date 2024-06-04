<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/DatabaseModel.php';

/**
 * @covers summary
 */
class DatabaseModelTest extends TestCase
{
    protected $databaseModel;
    protected $mysqli;




    protected function setUp(): void
    {
        $this->mysqli = new mysqli('test_db', 'deveroper', 'pass', 'test_db');
        $this->mysqli->begin_transaction();
        $this->databaseModel = new DatabaseModel($this->mysqli);
        $sql = "INSERT INTO locations (user_id, location,file_name,file_path) VALUES (28, '2階の部屋','razi.jpg', 'src/imgs/')";
        $this->mysqli->query($sql);
    }

    protected function tearDown(): void
    {
        $this->mysqli->rollback();
        $this->mysqli = null;
        $this->databaseModel = null;
    }

    public function testExecute()
    {
        $sql = "INSERT INTO locations (user_id, location,file_name,file_path) VALUES (?, ?,?, ?)";
        $params = ['isss',29,'2階の部屋', "razi.jpg", "src/imgs/"];
        $this->databaseModel->execute($sql,$params);

        $actual = $this->databaseModel->fetch('SELECT user_id, location, file_name, file_path FROM locations WHERE user_id =?', ['i',  29]);
        $expected = [
            'user_id' => 29,
            'location' => "2階の部屋",
            'file_name' => "razi.jpg",
            'file_path' => "src/imgs/",
        ];
        $this->assertEquals($expected, $actual[0]);
        $sql = "DELETE FROM locations WHERE user_id = 29";
        $this->mysqli->query($sql);
    }

    public function testFetch()
    {
        $actual = $this->databaseModel->fetch('SELECT file_path, location FROM locations WHERE user_id =?', ['i',  28]);
        $expected = [
            'file_path' => "src/imgs/",
            'location' => "2階の部屋"
        ];
        $this->assertEquals($expected, $actual[0]);
    }

    public function testGetInsertId()
    {
        $actual = $this->databaseModel->fetch('SELECT location_id FROM locations WHERE user_id =?', ['i',  28]);
        $actual = $actual[0]['location_id'];
        $expected = (int) $this->databaseModel->getInsertId();
        $this->assertEquals($expected, $actual);
    }


}
