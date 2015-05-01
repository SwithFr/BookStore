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
        if (!Session::isLogged()) {
            $this->redirect('notLogged', 'error');
        }

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
            $this->redirect('account', 'user');
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
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirect('missingParams', 'error');
        }

        $library = current($this->Librarie->get(['where' => 'id =' . $_GET['id'] . ' AND private = 0']));
        $this->loadModel('Book');
        $books = $this->Book->getAllFromLibrary('title, books.id, books.img, summary', $_GET['id']);

        return compact('library', 'books');
    }
}