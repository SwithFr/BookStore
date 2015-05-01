<?php

namespace Controllers;

use Components\Request;
use Components\Session;
use Components\Validator;
use Helpers\Image;
use Models\Interfaces\EditorsRepositoryInterface;

class EditorsController extends AppController
{
    function __construct(EditorsRepositoryInterface $editor, Request $request)
    {
        parent::__construct($request);
        $this->Editor = $editor;
    }

    /**
     * PAGE LISTE EDITEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/', ucfirst($_GET['letter']))) {
            $letters = $this->Editor->getLetters();
            $letter = $_GET['letter'];
            $editors = $this->Editor->getAllFromLetter("*", 'name', $letter);
        } else {
            $this->redirect('index', 'author', ['letter' => 'a']);
        }

        return compact("editors", "letter", "letters");
    }

    /**
     * AJOUT D'UN EDITEUR
     */
    public function add()
    {
        if (!Session::isLogged()) {
            $this->redirect('notLogged', 'error');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Editor->rules)) {
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                $errors = $v->errors();
                return compact('errors');
            }

            if (!empty($_FILES['img']['name'])) {
                $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'editors' . DS;
                Image::uploadImg($dest, $name);
            } else {
                $dest = $name = '';
            }

            $this->Editor->create($_POST['name'], $_POST['website'], $dest . $name, $_POST['history']);
            Session::setFlash('L‘éditeur ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' a bien été ajouté !');
            $this->redirect('edit', 'book');
        }
    }

    /**
     * Rechercher un éditeur
     * @return array
     */
    public function search()
    {
        $editors = $request = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && !empty($_POST['search'])) {
            $request = $_POST['search'];
            $editors = $this->Editor->search($request, ['name'], 'name, id');
        }

        return compact('editors', 'request');
    }

    /**
     * PAGE D'UN EDITEUR
     * @return array
     */
    public function view()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirect('missingParams', 'error');
        }

        $editor = $this->Editor->find($_GET['id']);
        if (!$editor) {
            Session::setFlash('L‘éditeur est introuvable !', 'error');
        }

        $this->loadModel('Book');
        $books = $this->Book->getAllFromEditor($editor->id);

        return compact('editor', 'books');
    }
} 