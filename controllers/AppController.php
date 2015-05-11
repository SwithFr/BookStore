<?php

namespace Controllers;

use Components\Request;
use Components\Session;
use Helpers\Html;

class AppController
{

    /**
     * L'objet Request contenant les infos de l'url
     * @var null|Request
     */
    protected $request = null;

    /**
     * Le layout à utiliser
     * @var string
     */
    public $layout = "default";

    /**
     * La vue à utiliser
     * @var null|string
     */
    public $view = null;

    /**
     * Si on a besoin de model ou non ?
     * @var bool
     */
    public $noModel = false;

    function __construct(Request $request)
    {
        # On inject la requete
        if (!isset($this->request)) {
            $this->request = $request;
        }

        # Si on a besoin d'être connecté et qu'on ne l'est pas on est redirigé vers la page de connexion
        if ($this->request->needAuth && !Session::isLogged()) {
            Session::setFlash('Vous devez être connecté pour effectuer cette action','error');
            $this->redirect('check', 'user');
        }

        # Génération de la vue controller+s/action.php
        $this->view = $this->request->controller . 's/' . $this->request->action . '.php';
    }

    /**
     * Permet d'injecter le model $name dans le controller
     * @param null $name
     */
    protected function loadModel($name = null)
    {
        # On prévoit le cas où on veut charger un model manuellement
        if (is_null($name)) {
            $name = ucfirst($this->request->controller);
        }
        $model = '\Models\\' . $name;
        $this->$name = new $model();
    }

    /**
     * Permet de faire une redirection
     * @param $action
     * @param $controller
     * @param null $params
     */
    protected function redirect($action, $controller, $params = null)
    {
        header('Location: ' . Html::url($action, $controller, $params));
        exit();
    }

} 