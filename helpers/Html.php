<?php

namespace Helpers;

class Html
{
    /**
     * Permet de générer un lien sous la forme index.php?a=$action&e=$controller
     * @param $action
     * @param $controller
     * @return string
     */
    public static function url($action, $controller)
    {
        return $_SERVER['PHP_SELF'] . '?a=' . $action . '&e=' . $controller;
    }
} 