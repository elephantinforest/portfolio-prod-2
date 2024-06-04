<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Search.php';
require_once __DIR__ . '/../models/Location.php';

class SearchTest extends TestCase
{
  protected $search;
  protected $register;
  protected $location;
  protected $mysqli;
  protected $registers;
  protected $locations;


  public function setUp(): void
  {
    $this->mysqli = new mysqli('test_db', 'deveroper', 'pass', 'test_db');
    $this->mysqli->begin_transaction();
    $this->search = new Search($this->mysqli);
    $this->location = new Location($this->mysqli);
    $this->locations = [
      [
        'user_id' => 300,
        'location' => 'サンプル部屋',
        'file_name' => 'tmp.jpg',
        'save_path' => 'sample.jpg',
      ],
      [
        'user_id' => 300,
        'location' => 'サンプルじゃない部屋',
        'file_name' => 'tmptmp.jpg',
        'save_path' => 'samplesample.jpg',
      ],
      [
        'user_id' => 300,
        'location' => 'サンプルじゃない方の部屋',
        'file_name' => 'ore.jpg',
        'save_path' => 'oreore.jpg',
      ]
    ];
    foreach ($this->locations as $Key => $value) {
      $this->location->insert($value);
      $lastInsertId = $this->mysqli->insert_id;
      $this->locations[$Key]['location_id'] = $lastInsertId;
    }
    $this->register = new Register($this->mysqli);
    $this->registers = [
      [
        'user_id' => 300,
        'location_id' => $this->locations[0]['location_id'],
        'name' => 'カップラーメン',
        'genre' => 'ジャンクフード',
        'other' => '味だけはいい',
        'price' => 200,
        'file_name' => 'sample.jpg',
        'file_path' => 'src/imgs/sample.jpg',
      ],
      [
        'user_id' => 300,
        'location_id' => $this->locations[1]['location_id'],
        'name' => 'レコードプレイヤー',
        'genre' => '趣味',
        'price' => 30000,
        'other' => '高校生の時に購入',
        'file_name' => 'sample2.jpg',
        'file_path' => 'src/imgs/sample2.jpg',
      ],
      [
        'user_id' => 300,
        'location_id' => $this->locations[2]['location_id'],
        'name' => 'ギター',
        'genre' => '趣味',
        'price' => 3000000,
        'other' => '高校生の時に購入 バイト代で購入',
        'file_name' => 'sample3.jpg',
        'file_path' => 'src/imgs/sample3.jpg',
      ]
    ];
    foreach ($this->registers as $Key => $value) {
      $this->register->insert($value);
      $lastInsertId = $this->mysqli->insert_id;
      $this->registers[$Key]['register_id'] = $lastInsertId;
    }
  }

  protected function tearDown(): void
  {
    $this->mysqli->rollback();
    $this->search = null;
    $this->mysqli = null;
  }

  public function testIndex()
  {
    $userId = 300;
    $searchWord = 'カップラーメン';
    $actual = $this->search->searchRegisters($userId, $searchWord);
    $actual = $actual[0];
    $expected =[
      'register_id' => $this->registers[0]['register_id'],
      'user_id' => 300,
      'location_id' => $this->locations[0]['location_id'],
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'price' => 200,
      'other' => '味だけはいい',
      'file_path' => 'src/imgs/sample.jpg',
      'location' => 'サンプル部屋'
    ];
    $searchWord = 'レコードプレイヤー';
    $actual2 = $this->search->searchRegisters($userId, $searchWord);
    $actual2 = $actual2[0];
    $expected2 = [
      'register_id' => $this->registers[1]['register_id'],
      'user_id' => 300,
      'location_id' => $this->locations[1]['location_id'],
      'name' => 'レコードプレイヤー',
      'genre' => '趣味',
      'price' => 30000,
      'other' => '高校生の時に購入',
      'file_path' => 'src/imgs/sample2.jpg',
      'location' => 'サンプルじゃない部屋',
    ];
    $searchWord = 'ギター';
    $actual3 = $this->search->searchRegisters($userId, $searchWord);
    $actual3 = $actual3[0];
    $expected3 = [
      'register_id' => $this->registers[2]['register_id'],
      'user_id' => 300,
      'location_id' => $this->locations[2]['location_id'],
      'name' => 'ギター',
      'genre' => '趣味',
      'price' => 3000000,
      'other' => '高校生の時に購入 バイト代で購入',
      'file_path' => 'src/imgs/sample3.jpg',
      'location' => 'サンプルじゃない方の部屋',
    ];
    $this->assertSame($actual,$expected);
    $this->assertSame($actual2, $expected2);
    $this->assertSame($actual3, $expected3);
  }
}
