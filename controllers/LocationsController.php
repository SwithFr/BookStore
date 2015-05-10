<?php

namespace Controllers;

use Components\Request;
use Components\Session;
use Components\Validator;
use Models\Interfaces\LocationsRepositoryInterface;

class LocationsController extends AppController
{
    function __construct(LocationsRepositoryInterface $location, Request $request)
    {
        parent::__construct($request);
        $this->Location = $location;
    }

    public function add()
    {
        if (!isset($_GET['library'])) {
            $this->redirect('missingParams', 'error');
        } else {
            $library_id = $_GET['library'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Location->rules)) {
                $errors = $v->errors();
                Session::setFlash('Veuillez vérifier vos informations !', 'error');
                return compact('errors', 'library_id');
            }

            $this->Location->create($_POST['name'], $library_id);
            Session::setFlash('Votre emplacement ' . $_POST['name'] . ' a bien été ajouté !');
            $this->redirect('account', 'user');
        }
        return compact('library_id');
    }
} 