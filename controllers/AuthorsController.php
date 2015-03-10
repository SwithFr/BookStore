<?php

namespace Controllers;

use Components\Session;
use Components\Validator;
use Helpers\Image;

class AuthorsController extends AppController
{
    /**
     * PAGE LISTE AUTEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/', ucfirst($_GET['letter']))) {
            $letter = $_GET['letter'];
            $authors = $this->Author->getAllFromLetter("*", 'last_name', $letter);
        } else
            $this->redirect('index', 'author', ['letter' => 'a']);

        return compact("authors", "letter");
    }

    public function add()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged', 'error');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Author->rules)) {
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                $errors = $v->errors();
                return compact('errors');
            }

            $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'authors' . DS;
            Image::uploadImg($dest, $name);
            if(empty($_POST['date_death']))
                $_POST['date_death'] = '0000-00-00';

            $this->Author->create($_POST['first_name'], $_POST['last_name'], $dest . $name, $_POST['date_birth'], $_POST['date_death'], $_POST['bio']);
            Session::setFlash('L‘auteur ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' a bien été ajouté !');
            $this->redirect('add','book');
        }
    }

} 