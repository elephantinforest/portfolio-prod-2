<?php

class Location extends DatabaseModel
{
  /** @phpstan-ignore-next-line */
  //ログイン時に取得する最初に登録されたロケーション
  public function fetchLocation(int $id): mixed
  {
     $location = $this->fetch(" SELECT location_id, file_path , location FROM locations WHERE user_id = ? AND created_at = (SELECT MIN(created_at) FROM locations WHERE user_id = ?)", ['ii', $id,$id]);
     if(empty($location)) {
      return $location;
     }
     return $location[0];
  }
  //ユーザーが所有するすべてのロケーション
  public function fetchLocations(string $id): mixed
  {
    return $this->fetch("SELECT location_id,  file_path , location FROM locations WHERE user_id = ?", ['i', $id]);
  }

  public function fetchUpdateLocation(int $locationId ): mixed
  {
    $location = $this->fetch("SELECT location_id, file_path , location FROM locations WHERE location_id = ?", ['i', $locationId]);
    return $location[0];
  }

  //テーブルにレコードを登録
  public function insert(array $registers): void
  {
    $this->execute('INSERT INTO locations (user_id, location, file_name, file_path) VALUES (?,?,?,?)', ['isss', $registers['user_id'], $registers['location'], $registers['file_name'], $registers['save_path']]);
  }

    // public function update( string $location,int $userNumber,): void
    // {
    //   $this->execute('UPDATE registers SET location = ? WHERE emp_number = ?', ['si',  $location, $userNumber]);
    // }


  //ユーザーが登録しているロケーションに重複がないかチェック
  public function existLocation(int $userId, string $location)
  {
    return $this->fetch('SELECT location FROM locations WHERE user_id =? AND location = ? ' ,['is',$userId,$location]);
  }

  //前ページ変更の時に返すクエリ
  public function prevReturn(int $locationId, int $userId)
  {
    $location = $this->fetch('SELECT * FROM locations WHERE created_at < (SELECT created_at FROM locations WHERE location_id = ?) AND user_id = ? ORDER BY created_at DESC LIMIT 1', ['ii', $locationId, $userId]);
    return $location;
  }
  //次ページ変更の時に返すクエリ
  public function nextReturn(int $locationId, int $userId)
  {
    $location = $this->fetch('SELECT * FROM locations WHERE created_at > (SELECT created_at FROM locations WHERE location_id = ?) AND user_id = ? ORDER BY created_at  LIMIT 1', ['ii', $locationId, $userId]);
    return $location;
  }
  public function delete(int $locationId): void
  {
    $this->execute('DELETE  FROM locations  WHERE location_id = ?', ['s', $locationId]);
  }

}
