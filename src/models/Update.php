<?php

class Update extends DatabaseModel
{
  public function fetchRegister(string $id, string $location): mixed
  {
    return $this->fetch("SELECT * FROM registers AS r  INNER JOIN positions AS p ON r.register_id = p.register_id  WHERE user_id = ? AND location = ?" , ['is',$id, $location]);
  }

}
