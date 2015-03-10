<?php

namespace Controllers;

use Components\Session;

class LibrariesController extends AppController
{
    /**
     * Formulaire d'ajout de librairie
     */
    public function add()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged','error');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Librarie->rules)) {
                Session::setFlash("Verifiez vos informations !", 'error');
                $errors = $v->errors();
                return compact("errors");
            }
            $private = isset($_POST['private']) ? true : false;
            $this->Librarie->create($_POST['name'], $_POST['address'], $_POST['tel'], $_POST['email'], $_SESSION['user_id'], $private);
            Session::setFlash('La bibliothèque ' . $_POST['name'] . 'a bien été ajoutée !');
            $this->redirect('account','user');
        }
    }
}