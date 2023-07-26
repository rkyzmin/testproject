<?php

use Models\Blocks;
use Models\User;

class Ajax
{
    private $action;

    public function __construct()
    {
        $this->action = $_REQUEST['action'];
    }

    public function getAction()
    {
        return $this->action;
    }
}

$actions = new Ajax();
$blocks = new Blocks();
$user = new User();

if ($actions->getAction() === 'add') {
    if (key_exists('name', $_GET)) {
        if (!empty($_GET['name'])) {
            $values = [
                $_GET['name'], $_GET['description'], date('Y-m-d h:i:s')
            ];

            $fields = [
                'name', 'description', 'created_at'
            ];

            if (key_exists('parent', $_GET)) {
                array_push($fields, 'parent');
            }

            if (key_exists('parent', $_GET)) {
                array_push($values, $_GET['parent']);
            }

            $blocks->add($fields, $values);
        }
    }
}

if ($actions->getAction() === 'delete') {
    $id = $_GET['id'];
    $blocks->deleteElements($id);
}

if ($actions->getAction() === 'update') {
    $fields = ['name' => $_GET['name']];

    if (key_exists('description', $_GET)) {
        $fields['description'] = $_GET['description'];
    }

    $blocks->update($fields, $_GET['id']);
}

if ($actions->getAction() === 'login') {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $user->checkUser($username, $password);
}

if ($actions->getAction() === 'logout') {
    $_SESSION['is_login'] = false;
    $_SESSION['user_login'] = false;
}
