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
            $letter = $_GET['letter'];
            $editors = $this->Editor->getAllFromLetter("*", 'name', $letter);
        } else
            $this->redirect('index', 'author', ['letter' => 'a']);

        return compact("editors", "letter");
    }

    public function add()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged', 'error');

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
            $this->redirect('add', 'book');
        }
    }
} 