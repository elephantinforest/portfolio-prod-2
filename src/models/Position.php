<?php

class Position extends DatabaseModel
{
    /** @phpstan-ignore-next-line */
    public function fetchPosition(int $registerId)
    {
        $existPosition = $this->fetch("SELECT * FROM positions  WHERE register_id = ? ", ['i', $registerId]);
        return $existPosition[0];
    }

    public function insertPosition(array $registers): void
    {
        $this->execute('INSERT INTO positions (register_id, left_position, top_position) VALUES (?,?,?)', ['idd', $registers['registerId'], $registers['x'],  $registers['y']]);
    }

    public function checkRegisterId($registerId)
    {
        $existPosition = $this->fetch("SELECT COUNT(register_id) FROM positions  WHERE register_id = ? ", ['i', $registerId]);
        // foreach ($existPosition as $position) {
        //     $bool = in_array(0, $position);
        // }
        $count =$existPosition[0]['COUNT(register_id)'];
        $result = 0 < $count;
        return $result;
    }

    public function updatePosition(array $registers): void
    {
        $this->execute('UPDATE positions SET  left_position = ?, top_position = ?  WHERE register_id = ?', ['ddi', $registers['x'], $registers['y'], $registers['registerId'],]);
    }

    public function deletePosition(int $registerId): void
    {
        $this->execute('DELETE  FROM positions  WHERE register_id = ?', ['i', $registerId]);
    }
}
