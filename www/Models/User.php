<?php

namespace Models;

use base\Database;

class User extends Database
{
    protected $table = 'users';

    public function checkUser($username, $password)
    {
        $getUser = $this->show(['username', 'password'], ['username' => $username]);

        if (password_verify($password, $getUser[0]['password'])) {
            $_SESSION['is_login'] = true;
            $_SESSION['user_login'] = $getUser[0]['username'];
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 503]);
        }
    }
}
