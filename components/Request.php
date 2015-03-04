<?php

class Request
{

    public $controller = null; # Le controller demandé
    public $action = null; # L'action demandée
    public $method = null; # La méthode HTTP
    public $id = null; # Si un id (valid) est passé en GET

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

            # Verification si action permise
            if (!in_array($route, $routes)) {
                die("Cette action n'est pas possible");
            }
        }

        # On défini la méthode
        $this->method = $_SERVER['REQUEST_METHOD'];

        # On défini l'id
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $this->id = $_GET['id'];
        }
    }


} 