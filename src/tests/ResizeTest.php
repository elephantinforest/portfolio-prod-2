<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Resize.php';

class ResizeTest extends TestCase
{
  protected $resize;
  protected $mysqli;
  protected $resizes;

  public function setUp(): void
  {
    $this->mysqli = new mysqli('test_db', 'deveroper', 'pass', 'test_db');
    $this->mysqli->begin_transaction();
    $this->resize = new Resize($this->mysqli);
    $this->resizes = [
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
    $this->resize->insert($this->resizes[0]);
    $this->resize->insert($this->resizes[1]);
  }

  protected function tearDown(): void
  {
    $this->mysqli->rollback();
    $this->resize = null;
    $this->mysqli = null;
    $this->resizes = null;
  }

  public function testFetchResize()
  {
    $actual = $this->resize->fetchResize(2);
    $expected =
      [
        'register_id' => 2,
        'width' => 300,
        'height' => 400,
      ];
    $this->assertSame($actual, $expected);
  }

  public function testInsert()
  {
    $resize = [
      'registerId' => 3,
      'width' => 500,
      'height' => 500,
    ];
    $this->resize->insert($resize);
    $actual = $this->resize->fetchResize(3);
    $expected =
      [
        'register_id' => 3,
        'width' => 500,
        'height' => 500,
      ];
    $this->assertSame($actual, $expected);
  }
  public function testExistId()
  {
    $result = $this->resize->existId(2);
    $result2 = $this->resize->existId(4);
    $this->assertTrue($result);
    $this->assertEmpty($result2);
  }
  public function testUpdate()
  {
    $resize = [
      'registerId' => 2,
      'width' => 200,
      'height' => 200,
    ];
    $this->resize->update($resize);
    $actual = $this->resize->fetchResize(2);
    $expected =
      [
        'register_id' => 2,
        'width' => 200,
        'height' => 200,
      ];
      $this->assertSame($actual,$expected);
  }

  public function testDelete()
  {
    $this->resize->delete(2);
    $result = $this->resize->fetchResize(2);
    $this->assertEmpty($result);
  }
}
