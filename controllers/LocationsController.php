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

    /**
     * Ajouter un emplacement
     */
    public function add()
    {
        if (!$this->request->checkParams(['library' => 'id'])) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
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
            $this->redirect('edit', 'librarie', ['library'=>$_GET['library']]);
        }
    }

    /**
     * Editer un emplacement
     * @return array
     */
    public function edit()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
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
                $this->Location->update($location->id, $location);
            } else {
                Session::setFlash('Verifiez vos informations', 'error');
                $errors = $v->errors();
            }
        }

        return compact('location', 'errors');
    }

    /**
     * Confirmer la suppression
     */
    public function delete()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $location = $this->Location->find(null, $_GET['id']);

        if(!$location) {
            Session::setFlash('Cet emplacement n‘existe pas', 'error');
            $this->redirect('manage','librarie');
        }

        return compact('location');
    }

    /**
     * Supprimer un emplacement
     */
    public function goDelete()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        if (!$this->request->checkParams(['library' => 'id'])) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $this->Location->delete($_GET['id']);
        $this->Location->deleteLocationAssoc($_GET['id']);
        Session::setFlash('L‘emplacement a bien été supprimé !');
        $this->redirect('edit', 'librarie', ['library'=>$_GET['library']]);
    }
} 