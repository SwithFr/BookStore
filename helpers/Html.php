<?php


class Html 
{
    public static function url($action,$controller)
    {
        return $_SERVER['PHP_SELF'] . '?a=' . $action . '&e=' . $controller;
    }
} 