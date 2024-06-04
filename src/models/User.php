<?php

class User extends DatabaseModel
{
    /** @phpstan-ignore-next-line */
    public function fetchUser(string $email)
    {
        $user = $this->fetch("SELECT * FROM users WHERE email =?",['s',$email]);
        if(empty($user)) {
            return null;
        }
        return $user[0];
        // return $this->fetchAll('SELECT  * FROM users WHERE email = ' . '. email .');
    }

    public function insert(string $name, string $email, string $password): void
    {
        $this->execute('INSERT INTO users (name, email, password) VALUES (?,?,?)', ['sss', $name, $email, $password]);
    }
    public function delete(string $email): void
    {
        $this->execute('DELETE  FROM users  WHERE email = ?', ['s', $email]);
    }

}
