<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Register.php';
require_once __DIR__ . '/../models/Position.php';
require_once __DIR__ . '/../models/Resize.php';
require_once __DIR__ . '/../models/Location.php';

class RegisterTest extends TestCase
{
  protected $register;
  protected $position;
  protected $resize;
  protected $location;
  protected $mysqli;
  protected $registers;
  protected $registerId;

  public function setUp(): void
  {
    $this->mysqli = new mysqli('test_db', 'deveroper', 'pass', 'test_db');
    $this->mysqli->begin_transaction();
    $this->register = new Register($this->mysqli);
    $this->registers = [
      [
        'user_id' => 300,
        'location_id' => 1,
        'name' => 'カップラーメン',
        'genre' => 'ジャンクフード',
        'other' => '味だけはいい',
        'price' => 200,
        'file_name' => 'sample.jpg',
        'file_path' => 'src/imgs/sample.jpg',
      ],
      [
        'user_id' => 300,
        'location_id' => 1,
        'name' => 'レコードプレイヤー',
        'genre' => '趣味',
        'price' => 30000,
        'other' => '高校生の時に購入',
        'file_name' => 'sample2.jpg',
        'file_path' => 'src/imgs/sample2.jpg',
      ],
      [
        'user_id' => 400,
        'location_id' => 2,
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
    $this->register = null;
    $this->position = null;
    $this->resize = null;
    $this->location = null;
    $this->mysqli = null;
    $this->registers = null;
  }

  public function testFetchLocationRegister()
  {
    $this->position = new Position($this->mysqli);
    $this->resize = new Resize($this->mysqli);

    $positions = [
      [
        'registerId' => $this->registers[0]['register_id'],
        'x' => 100,
        'y' => 200,
      ],
      [
        'registerId' => $this->registers[1]['register_id'],
        'x' => 300,
        'y' => 400,
      ],
      [
        'registerId' => $this->registers[2]['register_id'],
        'x' => 600,
        'y' => 700,
      ]
    ];
    $resizes = [
      [
        'registerId' => $this->registers[0]['register_id'],
        'width' => 500,
        'height' => 500,
      ],
      [
        'registerId' => $this->registers[1]['register_id'],
        'width' => 700,
        'height' => 700,
      ],
      [
        'registerId' => $this->registers[2]['register_id'],
        'width' => 700,
        'height' => 700,
      ]
    ];
    $this->position->insertPosition($positions[0]);
    $this->position->insertPosition($positions[1]);
    $this->position->insertPosition($positions[2]);
    $this->resize->insert($resizes[0]);
    $this->resize->insert($resizes[1]);
    $this->resize->insert($resizes[2]);



    $actual = $this->register->fetchLocationRegister(300, 1);
    $expected = [
      [
        'register_id' => $this->registers[0]['register_id'],
        'user_id' => 300,
        'location_id' => 1,
        'name' => 'カップラーメン',
        'genre' => 'ジャンクフード',
        'price' => 200,
        'other' => '味だけはいい',
        'file_path' => 'src/imgs/sample.jpg',
        'left_position' => 100.0,
        'top_position' => 200.0,
        'width' => 500,
        'height' => 500
      ],
      [
        'register_id' => $this->registers[1]['register_id'],
        'user_id' => 300,
        'location_id' => 1,
        'name' => 'レコードプレイヤー',
        'genre' => '趣味',
        'price' => 30000,
        'other' => '高校生の時に購入',
        'file_path' => 'src/imgs/sample2.jpg',
        'left_position' => 300.0,
        'top_position' => 400.0,
        'width' => 700,
        'height' => 700
      ],
    ];

    $actual2 = $this->register->fetchLocationRegister(400, 2);

    $expected2 = [
      [
        'register_id' => $this->registers[2]['register_id'],
        'user_id' => 400,
        'location_id' => 2,
        'name' => 'ギター',
        'genre' => '趣味',
        'price' => 3000000,
        'other' => '高校生の時に購入 バイト代で購入',
        'file_path' => 'src/imgs/sample3.jpg',
        'left_position' => 600.0,
        'top_position' => 700.0,
        'width' => 700,
        'height' => 700
      ],
    ];
    $this->assertSame($actual, $expected);
    $this->assertSame($actual2, $expected2);
  }

  public function testFetchRegister()
  {
    $actual = $this->register->fetchRegister($this->registers[0]['register_id']);
    $expected = [
      'register_id' => $this->registers[0]['register_id'],
      'user_id' => 300,
      'location_id' => 1,
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'price' => 200,
      'other' => '味だけはいい',
      'file_path' => 'src/imgs/sample.jpg'
    ];
    $this->assertSame($actual, $expected);
  }

  public function testFetchUpdateRegister()
  {
    $this->location = new Location($this->mysqli);
    $locations = [
      'user_id' => 300,
      'location' => 'サンプル部屋',
      'file_name' => 'tmp.jpg',
      'save_path' => 'sample.jpg',
    ];
    $this->location->insert($locations);
    $locationId = $this->mysqli->insert_id;
    $register = [
      'user_id' => 300,
      'location_id' => $locationId,
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'other' => '味だけはいい',
      'price' => 200,
      'file_name' => 'sample.jpg',
      'file_path' => 'src/imgs/sample.jpg',
    ];
    $this->register->insert($register);
    $registerId = $this->mysqli->insert_id;
    $actual = $this->register->fetchUpdateRegister($registerId);
    $expected = [
      'register_id' => $registerId,
      'user_id' => 300,
      'location_id' => $locationId,
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'price' => 200,
      'other' => '味だけはいい',
      'location' => 'サンプル部屋'
    ];
    $this->assertSame($actual, $expected);
  }

  public function testInsert()
  {
    $register = [
      'user_id' => 300,
      'location_id' => 1,
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'other' => '味だけはいい',
      'price' => 200,
      'file_name' => 'sample.jpg',
      'file_path' => 'src/imgs/sample.jpg',
    ];
    $this->register->insert($register);
    $registerId = $this->mysqli->insert_id;
    $actual = $this->register->fetchRegister($registerId);
    $expected =
      [
        'register_id' => $registerId,
        'user_id' => 300,
        'location_id' => 1,
        'name' => 'カップラーメン',
        'genre' => 'ジャンクフード',
        'price' => 200,
        'other' => '味だけはいい',
        'file_path' => 'src/imgs/sample.jpg',
      ];
    $this->assertSame($actual, $expected);
  }

  public function testUpdate()
  {
    $register = [
      'user_id' => 300,
      'location_id' => 100,
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'other' => '味だけはいい',
      'price' => 200,
      'file_name' => 'sample.jpg',
      'file_path' => 'src/imgs/sample.jpg',
    ];
    $this->register->insert($register);
    $registerId = $this->mysqli->insert_id;
    $this->register->update(200, $registerId);
    $actual = $this->register->fetchRegister($registerId);
    $actual = $actual['location_id'];
    $expected = 200;
    $this->assertSame($actual, $expected);
  }

  public function testUpdateRegister()
  {
    $register = [
      'user_id' => 300,
      'location_id' => 100,
      'name' => 'カップラーメン',
      'genre' => 'ジャンクフード',
      'other' => '味だけはいい',
      'price' => 200,
      'file_name' => 'sample.jpg',
      'file_path' => 'src/imgs/sample.jpg',
    ];
    $this->register->insert($register);
    $registerId = $this->mysqli->insert_id;
    $register = [
      'register_id' => $registerId,
      'name' => 'インスタントラーメン',
      'genre' => 'ファストフード',
      'other' => '味もよくない',
      'price' => 300,
      'file_name' => null,
      'file_path' => null,
    ];
    $this->register->updateRegister($register);
    $actual = $this->register->fetchRegister($registerId);
    $expected =
      [
        'register_id' => $registerId,
        'user_id' => 300,
        'location_id' => 100,
        'name' => 'インスタントラーメン',
        'genre' => 'ファストフード',
        'price' => 300,
        'other' => '味もよくない',
        'file_path' => 'src/imgs/sample.jpg',
      ];
    $this->assertSame($actual, $expected);
  }
  public function testFetchPagenation()
  {
    $userId = 300;
    $locationId = 1;
    $actual = $this->register->fetchPagenation($userId, $locationId);
    $expected = [
      [
        'register_id' => $this->registers[0]['register_id'],
        'name' => $this->registers[0]['name']
      ],
      [
        'register_id' => $this->registers[1]['register_id'],
        'name' => $this->registers[1]['name']
      ]
    ];

    $this->assertSame($actual, $expected);
  }
  public function testDelete()
  {
    $registerId = $this->registers[0]['register_id'];
    $this->register->delete($registerId);
    $result = $this->register->fetchRegister($registerId);
    $this->assertEmpty($result);
  }
}
