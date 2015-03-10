<?php

namespace Controllers;

use Components\Session;
use Components\Validator;

class LocationsController extends AppController
{
    public function add()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged', 'error');

        if (!isset($_GET['library']))
            $this->redirect('missingParams', 'error');
        else
            $library_id = $_GET['library'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if(!$v->validate($_POST,$this->Location->rules)) {
                $errors = $v->errors();
                Session::setFlash('Veuillez vérifier vos informations !', 'error');
                return compact('errors','library_id');
            }

            $this->Location->create($_POST['name'],$library_id);
            Session::setFlash('Votre emplacement ' . $_POST['name'] . ' a bien été ajouté !');
            $this->redirect('account','user');
        }
        return compact('library_id');
    }
} 