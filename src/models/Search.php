<?php

class Search extends DatabaseModel
{
  /** @phpstan-ignore-next-line */
  public function searchRegisters(int $id, string $string): mixed
  {
    return $this->fetch("SELECT r.register_id,r.user_id,r.location_id,r.name,r.genre,r.price,r.other,r.file_path,l.location  FROM registers AS r INNER JOIN locations AS l ON r.location_id = l.location_id WHERE  r.user_id = ?  AND name LIKE ?", ['is', $id, $string]);
  }
}
