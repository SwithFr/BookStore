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
        if (!$this->request->checkParams(['library' => 'id'])) {
            $this->redirect('missingParams', 'error');
        }

        if ($this->request->isPost()) {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Location->rules)) {
                $errors = $v->errors();
                Session::setFlash('Veuillez vérifier vos informations !', 'error');
                return compact('errors', 'library_id');
            }

            $this->Location->create($_POST['name'], $_GET['library']);
            Session::setFlash('Votre emplacement ' . $_POST['name'] . ' a bien été ajouté !');
            $this->redirect('manage', 'library');
        }
    }

    public function edit()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $location = $this->Location->find(null, $_GET['id']);
        if (!$location) {
            Session::setFlash('Cet emplacement n‘existe pas', 'error');
        }

        $errors = [];

        if ($this->request->isPost()) {
            $location->name = $_POST['name'];
            $v = new Validator();
            if ($v->validate($_POST, $this->Location->rules)) {
                Session::setFlash('L‘emplcament à bien été modifié');
                $this->Location->update($location->name, $location->id);
            } else {
                Session::setFlash('Verifiez vos informations', 'error');
                $errors = $v->errors();
            }
        }

        return compact('location', 'errors');
    }
} 