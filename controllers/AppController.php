<?php

class AppController {

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

    function __construct(Request $request)
    {
        # On inject la requete
        if (!isset($this->request))
            $this->request = $request;

        # On charge le model par defaut
        $this->loadModel();

        # Si on a une fonctin d'administration on charge le layout admin
        if (preg_match("/admin_/",$this->request->action)) {
            $this->layout = "admin";
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
        if($name != 'Error')
            $this->$name = new $name();
    }

} 