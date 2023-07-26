<?php

use Models\User;
// $username = 'admin';
// $password = 'admin12345root';
?>

<div class="login-form">
    <form method="POST" action="#">
        <h3>Вход</h3>
        <input placeholder="Логин" id="username" type="text" class="login-form__username" />
        <input placeholder="Пароль" id="password" type="password" class="login-form__password" />
        <input type="submit" value="Войти" />
    </form>
</div>