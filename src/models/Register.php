<?php

class Register extends DatabaseModel
{
    /** @phpstan-ignore-next-line */
    //ユーザーが所有してるロケーションIDのレジスターアイテム取得
    public function fetchLocationRegister(int $userId, int $locationId)
    {
        $registers =  $this->fetch("SELECT r.register_id, r.user_id, r.location_id, r.name, r.genre, r.price, r.other, r.file_path, p.left_position, p.top_position, rs.width, rs.height, rs.window_width,rs.window_height FROM registers AS r INNER JOIN positions AS p ON r.register_id = p.register_id LEFT JOIN resizes AS rs ON r.register_id = rs.register_id WHERE user_id = ? AND location_id = ?", ['is', $userId, $locationId]);
        return $registers;
    }
    //レジスターIDを使い一つのアイテム取得
    public function fetchRegister(string $registerId)
    {
        $register = $this->fetch("SELECT register_id, user_id,location_id,name,genre,price,other, file_path FROM registers   WHERE register_id = ?", ['i', $registerId]);
        if (empty($register)) {
            return null;
        }
        return $register[0];
    }
    public function fetchUpdateRegister(string $registerId)
    {
        $register = $this->fetch("SELECT register_id, r.user_id,r.location_id,name,genre,price,other, l.location FROM registers AS r INNER JOIN locations AS l  ON r.location_id = l.location_id   WHERE register_id = ?", ['i', $registerId]);
        if (empty($register)) {
            return null;
        }
        return $register[0];
    }

    public function insert(array $registers): void
    {
        $this->execute('INSERT INTO registers (user_id, location_id, name,  genre,  price, other, file_name, file_path) VALUES (?,?,?,?,?,?,?,?)', ['iississs', $registers['user_id'], $registers['location_id'], $registers['name'],  $registers['genre'], $registers['price'], $registers['other'], $registers['file_name'], $registers['file_path']]);
    }

    public function update(int $locationId, string $registerId): void
    {
        $this->execute('UPDATE registers SET location_id = ? WHERE register_id = ?', ['ii', $locationId, $registerId]);
    }

    public function updateRegister(array $register): void
    {
        if (is_null($register['file_name'])) {
            $this->execute('UPDATE registers SET  name = ?,  genre = ?,  price = ?,   other = ?  WHERE register_id = ?', ['ssisi', $register['name'], $register['genre'], (int) $register['price'], $register['other'], (int) $register['register_id']]);
        } else {
            $this->execute('UPDATE registers SET  name = ?,  genre = ?,  price = ?,   other = ?, file_name = ?, file_path = ? WHERE register_id = ?', ['ssisssi', $register['name'], $register['genre'], (int) $register['price'], $register['other'], $register['file_name'], $register['file_path'], (int) $register['register_id']]);
        }
    }


    public function fetchPagenation(int $user_id, int $locationId)
    {
        return $this->fetch("SELECT register_id, name FROM registers WHERE user_id = ? AND location_id = ?", ['ii', $user_id, $locationId]);
    }


    public function delete(int $registerId): void
    {
        $this->execute('DELETE  FROM registers  WHERE register_id = ?', ['i', $registerId]);
    }
}
