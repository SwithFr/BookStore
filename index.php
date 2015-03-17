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
require('./vendor/autoload.php');
use Components\Request;

# Initialisation de la requête
$request = new Request();

# Création du container d'injection de dépendances
$container = new \Illuminate\Container\Container();

# Génération du nom du controller Model+s+Controller
$controllerName = '\\Controllers\\' . ucfirst($request->controller) . 's' . 'Controller';

# Initialisation du controller avec l'auto injection de dépendance
$controller = $container->make($controllerName);

# Récupération des données
$data = call_user_func([$controller, $request->action]);

# On inclue le layout
include(D_VIEWS . DS . 'layouts' . DS . $controller->layout . '.php');