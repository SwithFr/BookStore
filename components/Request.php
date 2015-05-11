<?php

namespace Components;

use Helpers\Html;

class Request
{

    /**
     * Le controller demandé par la requête
     * @var string [null]
     */
    public $controller = null;

    /**
     * L'action demandé par la requête
     * @var string [null]
     */
    public $action = null; # L'action demandée

    /**
     * Si un id (valid) est passé en GET
     * @var int [null]
     */
    public $id = null;

    /**
     * Url demandée par l'utilisateu
     * @var null|string
     */
    public $url = null;

    /**
     * Doit on être connecté pour une action ?
     * @var bool
     */
    public $needAuth = false;

    function __construct()
    {
        $routes = include('./configs/routes.php');
        $routeParts = explode('/', $routes['default']);
        $this->action = $routeParts[0];
        $this->controller = $routeParts[1];

        # On défini l'action et le controller
        if (isset($_REQUEST['a']) && isset($_REQUEST['e'])) {
            $this->action = $_REQUEST['a'];
            $this->controller = $_REQUEST['e'];
            $route = $this->action . '/' . $this->controller;
            $this->url = $route;

            # Verification si action permise
            if (!in_array($route, $routes)) {
                if(!in_array($route,$routes['needConnexion'])) {
                    header('Location: ' . Html::url('unauthorized', 'error'));
                } else {
                    $this->needAuth = true;
                }
            }
        }

        # On défini l'id
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $this->id = $_GET['id'];
        }
    }

    /**
     * vérifie si la requete est en POST
     * @return bool
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * Vérifie si la requete est en GET
     * @return bool
     */
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }


} 