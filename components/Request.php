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

        # On défini l'action et le controller
        if (isset($_REQUEST['a']) && isset($_REQUEST['e'])) {
            $this->action = $_REQUEST['a'];
            $this->controller = $_REQUEST['e'];
            $route = $this->action . '/' . $this->controller;

            # Verification si action permise
            if (!in_array($route, $routes)) {
                header('Location: ' . Html::url('unauthorized', 'error'));
            }
        }

        # On défini l'id
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $this->id = $_GET['id'];
        }
    }


} 