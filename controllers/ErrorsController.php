<?php

namespace Controllers;

class ErrorsController extends AppController
{
    public $layout = 'error';

    /**
     * Fonction d'erreur lorsque l'on tente d'accèder à une page non permise
     * @return array
     */
    public function unauthorized()
    {
        $message = "Hey bonhomme ! Je te conseille de ne pas aller plus loin...";
        return compact('message');
    }

    /**
     * Fonction d'erreur lorsqu'on tente d'accèder à une page reservée sans être connecté
     * @return array
     */
    public function notLogged()
    {
        $message = "Petit malin ! Tu n'es pas connecté...";
        return compact('message');
    }

    /**
     * Fonction d'erreur lorsque qu'un parametre est manquant
     * @return array
     */
    public function missingParams()
    {
        $message = "Tu n'aurais pas oublié quelque chose ?";
        return compact('message');
    }

    public function wrongMethod()
    {
        $message = "Erreur de methode";
        return compact('message');
    }

} 