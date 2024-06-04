<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Position.php';

class PositionTest extends TestCase
{
  protected $position;
  protected $mysqli;
  protected $positions;

  public function setUp(): void
  {
    $this->mysqli = new mysqli('test_db', 'deveroper', 'pass', 'test_db');
    $this->mysqli->begin_transaction();
    $this->position = new Position($this->mysqli);
    $this->positions = [
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
    $this->position->insertPosition($this->positions[0]);
    $this->position->insertPosition($this->positions[1]);
  }

  protected function tearDown(): void
  {
    $this->mysqli->rollback();
    $this->position = null;
    $this->mysqli = null;
    $this->positions = null;
  }

  public function testFetchPosition()
  {
    $actual = $this->position->fetchPosition(1);
    $actual = [
      'registerId' => $actual['register_id'],
      'x' => $actual['left_position'],
      'y' => $actual['top_position'],
    ];

    $expected =
      [
        'registerId' => 1,
        'x' => 100.0,
        'y' => 200.0,
      ];
    $this->assertSame($actual, $expected);
  }

  public function testInsertPosition()
  {

    $positions = [
      'registerId' => 3,
      'x' => 100,
      'y' => 200,
    ];
    $this->position->insertPosition($positions);
    $actual = $this->position->fetchPosition(3);
    $actual = [
      'registerId' => $actual['register_id'],
      'x' => $actual['left_position'],
      'y' => $actual['top_position'],
    ];

    $expected =
      [
        'registerId' => 3,
        'x' => 100.0,
        'y' => 200.0,
      ];
    $this->assertSame($actual, $expected);
  }

  public function testCheckRegisterId()
  {
    $result1 = $this->position->checkRegisterId(0);
    $result2 = $this->position->checkRegisterId(1);
    $this->assertFalse($result1);
    $this->assertTrue($result2);
  }

  public function testUpdatePosition()
  {

    $position =
      [
        'registerId' => 1,
        'x' => 500,
        'y' => 500,
      ];

    $this->position->updatePosition($position);
    $registerId = 1;
    $actual = $this->position->fetchPosition($registerId);
    $actual = [
      'registerId' => $actual['register_id'],
      'x' => $actual['left_position'],
      'y' => $actual['top_position'],
    ];
    $expected =
      [
        'registerId' => 1,
        'x' => 500.0,
        'y' => 500.0,
      ];
    $this->assertSame($actual, $expected);
  }
}
