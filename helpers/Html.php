<?php

namespace Helpers;

class Html
{
    /**
     * Créer une liste de pagination
     * @param $nbPages
     * @param $action
     * @param $controller
     * @param array $params
     * @return string
     */
    public static function paginate($nbPages, $action, $controller, $params = [])
    {
        if ($nbPages > 1) {
            $html = '<ul class="pagniation">';
            for ($i = 1; $i <= $nbPages; $i++) {
                $params = array_merge($params, ['page' => $i]);
                $active = ($i == $_GET['page']) ? 'pagination--active' : '';
                $link = $active ? '' : Html::url($action, $controller, $params);

                $html .= "<li class='pagniation__item $active'>";
                if ($i == $_GET['page']) {
                    $html .= $i . "</li>";
                } else {
                    $html .= "<a href='$link' >" . $i . "</a></li>";
                }
            }
            $html .= '</ul>';
        } else {
            $html = '';
        }
        return $html;
    }

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