<?php

namespace Helpers;

class Html
{
    /**
     * Permet de générer un lien sous la forme index.php?a=$action&e=$controller
     * @param $action
     * @param $controller
     * @param $params
     * @return string
     */
    public static function url($action, $controller, $params = null)
    {
        if (!is_null($params)) {
            $query = '&' . http_build_query($params);
        } else {
            $query = '';
        }
        return $_SERVER['PHP_SELF'] . '?a=' . $action . '&e=' . $controller . $query;
    }
}