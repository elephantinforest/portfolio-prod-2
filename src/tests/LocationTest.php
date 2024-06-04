<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Location.php';

class LocationTest extends TestCase
{
  protected $location;
  protected $mysqli;
  protected $locations;

  public function setUp(): void
  {
    $this->mysqli = new mysqli('test_db', 'deveroper', 'pass', 'test_db');
    $this->mysqli->begin_transaction();
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
    $this->location->insert($this->locations[0]);
    // sleep(1); // 5秒間プログラムを停止
    $this->location->insert($this->locations[1]);
    // sleep(1); // 5秒間プログラムを停止
    $this->location->insert($this->locations[2]);
    // sleep(1); // 5秒間プログラムを停止
  }

  protected function tearDown(): void
  {
    $this->mysqli->rollback();
    $this->location = null;
    $this->mysqli = null;
    $this->locations = null;
  }

  public function testFetchLocation()
  {
    $actual = $this->location->fetchLocation(300);

    $expected = $this->locations[0];

    // 期待値と実際の値を比較
    $this->assertSame($actual['file_path'], $expected['save_path']);
    $this->assertSame($actual['location'], $expected['location']);
  }

  public function testFetchLocations()
  {
    $actual = $this->location->fetchLocations(300);
    $expected = $this->locations;

    // 期待値と実際の値を比較
    $this->assertSame($actual[0]['file_path'], $expected[0]['save_path']);
    $this->assertSame($actual[0]['location'], $expected[0]['location']);
    $this->assertSame($actual[1]['file_path'], $expected[1]['save_path']);
    $this->assertSame($actual[1]['location'], $expected[1]['location']);
  }

  public function testFetchUpdateLocation()
  {
    $actual = $this->location->fetchLocation(300);
    $expected = $this->locations[0];


    // 期待値と実際の値を比較
    $this->assertSame($actual['file_path'], $expected['save_path']);
    $this->assertSame($actual['location'], $expected['location']);
  }
  public function testInsert()
  {
    // テスト用のコンテンツを設定
    $locations = [
      'user_id' => 400,
      'location' => 'サンプル部屋',
      'file_name' => 'tmp.jpg',
      'save_path' => 'sample.jpg',
    ];
    $this->location->insert($locations);

    $actual = $this->location->fetchLocation(400);

    $expected = $locations;

    // 期待値と実際の値を比較
    $this->assertSame($actual['file_path'], $expected['save_path']);
    $this->assertSame($actual['location'], $expected['location']);
  }

  public function testExistLocation()
  {
    $userId = 300;
    // 重複しない場合
    $result0 = $this->location->existLocation($userId, 'サンプルの部屋');
    $this->assertEmpty($result0); // 配列が空でないことを検証

    // 重複する場合
    $result1 = $this->location->existLocation($userId, 'サンプル部屋');
    $this->assertNotEmpty($result1); // 重複がある場合は true を返すことを期待

    // 重複する場合
    $result2 = $this->location->existLocation($userId, 'サンプルじゃない部屋');
    $this->assertNotEmpty($result2); // 重複がある場合は true を返すことを期待
  }

  public function testPrevReturn()
{
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
    $this->location->insert($this->locations[0]);
    sleep(1); // 5秒間プログラムを停止
    $this->location->insert($this->locations[1]);
    sleep(1); // 5秒間プログラムを停止
    $this->location->insert($this->locations[2]);
    $userId = 300;
    $result = $this->location->fetchLocations($userId);

    $locationId = $result[4]['location_id'];
    // 重複しない場合
    $actual = $this->location->prevReturn($locationId, $userId);
    $actual =$actual[0];
    $actual =[
      'user_id' => $actual['user_id'],
      'location' => $actual['location'],
      'file_name' => $actual['file_name'],
      'save_path' => $actual['file_path'],
    ];
    $expected = [
      'user_id' => 300,
      'location' => 'サンプル部屋',
      'file_name' => 'tmp.jpg',
      'save_path' => 'sample.jpg',
    ];
    $this->assertSame($actual,$expected);
  }
  public function testNextReturn()
  {
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
    $this->location->insert($this->locations[0]);
    sleep(1); // 5秒間プログラムを停止
    $this->location->insert($this->locations[1]);
    sleep(1); // 5秒間プログラムを停止
    $this->location->insert($this->locations[2]);
    $userId = 300;
    $result = $this->location->fetchLocations($userId);

    $locationId = $result[0]['location_id'];
    // 重複しない場合
    $actual = $this->location->nextReturn($locationId, $userId);
    $actual = $actual[0];
    $actual = [
      'user_id' => $actual['user_id'],
      'location' => $actual['location'],
      'file_name' => $actual['file_name'],
      'save_path' => $actual['file_path'],
    ];
    $expected =  [
        'user_id' => 300,
        'location' => 'サンプルじゃない部屋',
        'file_name' => 'tmptmp.jpg',
        'save_path' => 'samplesample.jpg',
    ];
    $this->assertSame($actual, $expected);
  }
}
