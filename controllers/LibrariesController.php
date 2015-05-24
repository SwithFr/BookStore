<?php

namespace Controllers;

use Components\Request;
use Components\Session;
use Components\Validator;
use Models\Interfaces\LibrariesRepositoryInterface;

class LibrariesController extends AppController
{
    function __construct(LibrariesRepositoryInterface $library, Request $request)
    {
        parent::__construct($request);
        $this->Librarie = $library;
    }

    /**
     * Formulaire d'ajout de librairie
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Librarie->rules)) {
                Session::setFlash("Verifiez vos informations !", 'error');
                $errors = $v->errors();
                return compact("errors");
            }
            $private = isset($_POST['private']) ? true : false;
            $this->Librarie->create($_POST['name'], $_POST['address'], $_POST['tel'], $_POST['email'], Session::getId(), $private);
            Session::setFlash('La bibliothèque ' . $_POST['name'] . 'a bien été ajoutée !');
            $this->redirect('index', 'user');
        }
    }

    /**
     * Affiche la liste des bibliothèques
     * @return array
     */
    public function index()
    {
        $libraries = $this->Librarie->get(['fields' => 'id, name']);

        if (!$libraries) {
            Session::setFlash('La bibliothèque est introuvable !', 'error');
        }

        return compact('libraries');
    }

    /**
     * Page d'une bibliothèque
     * @return array
     */
    public function view()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $library = current($this->Librarie->get(['where' => 'id =' . $_GET['id'] . ' AND private = 0']));
        $this->loadModel('Book');
        $nbPerPage = 10;
        $nbPages = ceil($this->Librarie->countBook($library->id) / $nbPerPage);
        $this->loadModel('Book');
        $books = $this->Book->paginate($nbPages, $nbPerPage, $library->id);

        return compact('library', 'books', 'nbPages');
    }

    /**
     * Gerer une bibliothèque
     * @return array
     */
    public function manage()
    {
        $library = $this->Librarie->getFromUser(Session::getId());
        if (!$library) {
            Session::setFlash('Une erreur est survenue', 'error');
        }

        $hasLocation = $this->Librarie->count('library_id = ' . $library->id, 'location_library');

        $nbPerPage = 10;
        $nbPages = ceil($this->Librarie->countBook($library->id) / $nbPerPage);
        $this->loadModel('Book');
        $books = $this->Book->paginate($nbPages, $nbPerPage, $library->id);

        return compact('library', 'books', 'nbPages', 'hasLocation');
    }

    /**
     * Editer une bibliothèque
     */
    public function edit()
    {
        if (!$this->request->checkParams(['library' => 'id'])) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $library = $this->Librarie->find(null, $_GET['library']);

        if (!$library) {
            Session::setFlash('Cette bibliothèque est introuvable', 'error');
            $this->redirect('manage', 'librarie');
        }

        $this->loadModel('Location');
        $locations = $this->Location->getAllFromUserLibrary($library->user_id);
        foreach($locations as $l) {
            $l->hasBooks = $this->Location->count('location_id = ' . $l->id, 'books');
        }

        $errors = [];

        if ($this->request->isPost()) {
            $library->name = $_POST['name'];
            $library->address = $_POST['address'];
            $library->tel = $_POST['tel'];
            $library->email = $_POST['email'];
            $library->private = isset($_POST['private']) ? 1 : 0;
            $v = new Validator();
            if ($v->validate($_POST, $this->Librarie->rules)) {
                Session::setFlash('Les informations on bien été modifiées.');
                $this->Librarie->update($library->id, $library);
                $this->redirect('edit', 'librarie', ['library'=>$library->id]);
            } else {
                Session::setFlash('Verifiez vos informations !', 'error');
                $errors = $v->errors();
            }
        }

        return compact('library', 'errors', 'locations');
    }
}