<?php

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

    function __construct()
    {
        $routes = include('./configs/routes.php');
        $routeParts = explode('/', $routes['default']);
        $this->action = $routeParts[0];
        $this->controller = $routeParts[1];

        # On défini la route
        if (isset($_SERVER['PATH_INFO'])) {
            $url = explode('/',trim($_SERVER['PATH_INFO'],'/'));
            $this->controller = $url[0];
            $this->action = $url[1];
            $route = $this->controller . '/' . $this->action;

            # Verification si action permise
            if (!in_array($route, $routes)) {
                die("Cette action n'est pas possible");
            }
        }

        # On défini l'id
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $this->id = $_GET['id'];
        }
    }


} 