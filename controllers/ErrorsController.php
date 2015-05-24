<?php

namespace Controllers;

class ErrorsController extends AppController
{
    public $layout = 'error';

    public function sendError()
    {
        $type = isset($_GET['type']) ? $_GET['type'] : 'unauthorized';

        if ($type == 'unauthorized') {
            $message = "Hey bonhomme ! Je te conseille de ne pas aller plus loin...";
        } else if ($type = 'notLogged') {
            $message = "Petit malin ! Tu n'es pas connecté...";
        } else if ($type = 'notLogged') {
            $message = "Petit malin ! Tu n'es pas connecté...";
        } else if ($type = 'missingParams') {
            $message = "Tu n'aurais pas oublié quelque chose ?";
        } else if ($type = 'wrongMethod') {
            $message = "Erreur de methode";
        }

        return compact('message');
    }
} 