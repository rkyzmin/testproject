<?php
namespace helpers;

class Functions
{
    public static function getName()
    {
        return $_SESSION['user_login'] ?: '';
    }

    public static function getCheckUser()
    {
        return $_SESSION['is_login'] ?: false;
    }

    public static function checkPageAdmin()
    {
        return $_REQUEST['page'] !== 'admin' ? true : false;
    }
}