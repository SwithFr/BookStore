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
            $this->loadModel('Book');
            foreach ($editors as $e) {
                $e->book_count = $this->Book->count('editor_id = ' . $e->id);
            }
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
        if ($this->request->isPost()) {
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

            $this->Editor->create($_POST['name'], $_POST['website'], $dest . $name, $_POST['history'], Session::getId());
            Session::setFlash('L‘éditeur ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' a bien été ajouté !');
            $this->redirect('index', 'user');
        }
    }

    /**
     * EDITER UN EDITEUR
     */
    public function edit()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $editor = $this->Editor->find(null,$_GET['id']);
        if (!$editor) {
            Session::setFlash('L‘éditeur est introuvable !', 'error');
        }

        $errors = [];

        if ($this->request->isPost()) {
            $editor->name = $_POST['name'];
            $editor->website = $_POST['website'];
            $editor->history = $_POST['history'];
            $v = new Validator();
            if ($v->validate($_POST, $this->Editor->rules)) {
                if (!empty($_FILES['img']['name'])) {
                    $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                    $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'editors' . DS;
                    $editor->img = $dest . $name;
                    Image::uploadImg($dest, $name);
                }
                $this->Editor->update($editor->id, $editor);
                Session::setFlash('Les informations ont été modifiées avec succès !');
                $this->redirect('manage', 'editor');
            } else {
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                $errors = $v->errors();
            }
        }

        return compact('editor', 'errors');
    }

    /**
     * Confirmer une suppression
     * @return array
     */
    public function delete()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $editor = $this->Editor->find(null, $_GET['id'], false, 'user_id = ' . Session::getId());

        if (!$editor) {
            Session::setFlash('Vous ne pouvez supprimer cet editeur', 'error');
            $this->redirect('manage', 'editor');
        }

        return compact('editor');
    }

    /**
     * Supprimer un éditeur
     */
    public function goDelete()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $this->Editor->delete($_GET['id']);
        Session::setFlash('L‘éditeur a bien été supprimé !');
        $this->redirect('manage', 'editor');
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
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $editor = $this->Editor->find(null, $_GET['id']);
        if (!$editor) {
            Session::setFlash('L‘éditeur est introuvable !', 'error');
        }

        $this->loadModel('Book');
        $books = $this->Book->getAllFromEditor($editor->id);

        return compact('editor', 'books');
    }

    /**
     * Gerer les éditeurs que l'on a ajoutés
     * @return array
     */
    public function manage()
    {
        $nbPerPage = 5;
        $nbPages = ceil($this->Editor->count('user_id = ' . Session::getId()) / $nbPerPage);
        $editors = $this->Editor->paginate($nbPages, $nbPerPage, Session::getId());

        foreach ($editors as $a) {
            if ($this->Editor->getBookCount($a->id) > 0) {
                $a->hasBooks = true;
            } else {
                $a->hasBooks = false;
            }
        }

        return compact('editors', 'nbPages');
    }
} 