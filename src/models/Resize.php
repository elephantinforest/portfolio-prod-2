<?php

class Resize extends DatabaseModel
{
  /** @phpstan-ignore-next-line */
  public function fetchResize(int $registerId)
  {
   $resize = $this->fetch("SELECT register_id, width, height FROM resizes  WHERE register_id = ? ", ['i', $registerId]);
   if(empty($resize)){
    return null;
   }
   return $resize[0];
  }

  public function insert(array $data): void
  {
    $this->execute('INSERT INTO resizes (register_id, width, height, window_width, window_height) VALUES (?,?,?,?,?)', ['iiiii', $data['registerId'], $data['width'],  $data['height'], $data['window_width'], $data['window_height']]);
  }

  public function existId(int $registerId)
  {
    $existId = $this->fetch("SELECT register_id FROM resizes  WHERE register_id = ? ", ['i', $registerId]);
    if(empty($existId[0])) {
      return false;
    }

    return true;
  }

  public function update(array $data): void
  {
    $this->execute('UPDATE resizes SET  width = ? , height = ? , window_width = ? , window_height = ? WHERE register_id = ?', ['iiiii',(int) $data['width'], (int) $data['height'], (int) $data['windowWidth'], (int)$data['windowHeight'], (int)  $data['registerId'],]);
  }

  public function updateWindowSize(array $data): void
  {
    $this->execute('UPDATE resizes SET  window_width = ? , window_height = ? WHERE register_id = ?', ['iii', $data['window_width'], $data['window_height'], $data['registerId'],]);
  }

  public function delete(int $registerId): void
  {
    $this->execute('DELETE  FROM resizes  WHERE register_id = ?', ['i', $registerId]);
  }
}
