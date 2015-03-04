<?php

# On démarre la session
session_start();

# On inclue les fichiers utiles
include('./configs/constantes.php');

# Ajout des dossier (controller,models) aux chemins d'inclusion
set_include_path(
    D_ASSETS . ':' .
    D_COMPONENTS . ':' .
    D_CONFIGS . ':' .
    D_CONTROLLERS . ':' .
    D_HELPERS . ':' .
    D_MODELS . ':' .
    D_VIEWS . ':' .
    get_include_path()
);

# Chargement automatique des classes
spl_autoload_register(
    function ($className) {
        include($className . '.php');
    }
);

# Initialisation de la requête
$request = new Request();

# Génération du nom du controller Model+s+Controller
$controllerName = ucfirst($request->controller) . 's' . 'Controller';

# Initialisation du controller
$controller = new $controllerName($request);

# Récupération des données
$data = call_user_func([$controller, $request->action]);

if (!empty($data))
    extract($data);


# On inclue le layout
include(D_VIEWS . DS . 'layouts' . DS . $controller->layout . '.php');