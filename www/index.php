<?php
date_default_timezone_set('UTC');
session_start();

spl_autoload_register(function ($class) {
    $path = $class . '.php';
    $path = str_replace('\\', '/', $path);
    if (file_exists($path)) require $path;
});

if (key_exists('action', $_REQUEST)) {
    require_once('helpers/ajax.php');
}

if ($_REQUEST['page'] === 'admin') {
    if (!$_SESSION['is_login']) {
        header('Location: http://localhost/?page=login');
    }
} 

if (key_exists('page', $_REQUEST)) {
    require_once('pages/template/template.php');
}

if (empty($_GET)) {
    header('Location: http://localhost/?page=main');
}