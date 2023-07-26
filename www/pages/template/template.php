<?php

use helpers\Functions;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Test project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="pages/template/css/style.css" />
</head>

<body>
    <div class="main-header">
        <div class="main-header__menu">
            <a href='/'>Главная</a>
            <?= Functions::getName() ? '<span class="logout">Выйти</span>' : '<a class="login" href="http://localhost/?page=login">Войти</a>' ?>
        </div>
    </div>
    <?= Functions::getName() ? '<span class="admin-phrase">Здравствуйте, ' . Functions::getName() . '</span>' : '' ?>
    <?php $page = $_REQUEST['page']; ?>
    <div class="main-blocks-wrapper">
        <?php require_once("pages/$page.php") ?>
    </div>
</body>

<script src="pages/template/js/script.js"></script>
</head>