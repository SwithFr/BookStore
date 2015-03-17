<?php

namespace Controllers;

use Carbon\Carbon;
use Components\Request;
use Components\Session;
use Components\Validator;
use Helpers\Image;
use Models\Interfaces\AuthorsRepositoryInterface;

class AuthorsController extends AppController
{
    function __construct(AuthorsRepositoryInterface $author, Request $request)
    {
        parent::__construct($request);
        $this->Author = $author;
    }

    /**
     * PAGE LISTE AUTEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/', ucfirst($_GET['letter']))) {
            $letter = $_GET['letter'];
            $authors = $this->Author->getAllFromLetter("first_name,last_name,date_birth,date_death,bio,id", 'last_name', $letter);
            foreach ($authors as $a) {
                $b = Carbon::parse($a->date_birth);
                $a->date_birth = $b->year;
                if ($a->date_death != '0000-00-00') {
                    $d_d = Carbon::parse($a->date_death);
                    $a->date_death = $d_d->year;
                } else {
                    $a->date_death = '';
                }
            }
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

            if (!empty($_FILES['img']['name'])) {
                $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'authors' . DS;
                Image::uploadImg($dest, $name);
            } else {
                $dest = $name = '';
            }

            if (empty($_POST['date_death']))
                $_POST['date_death'] = '0000-00-00';

            $this->Author->create($_POST['first_name'], $_POST['last_name'], $dest . $name, $_POST['date_birth'], $_POST['date_death'], $_POST['bio']);
            Session::setFlash('L‘auteur ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' a bien été ajouté !');
            $this->redirect('add', 'author');
        }
    }

    public function view()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id']))
            $this->redirect('missingParams', 'error');

        $author = $this->Author->find($_GET['id']);
        if (!$author)
            Session::setFlash('L‘auteur est introuvable !', 'error');

        $d_b = Carbon::parse($author->date_birth);
        $author->date_birth = $d_b->year;
        if ($author->date_death != '0000-00-00') {
            $d_d = Carbon::parse($author->date_death);
            $author->date_death = $d_d->year;
        } else {
            $author->date_death = '';
        }

        $this->loadModel('Book');
        $books = $this->Book->getAllFromAuthor($author->id);

        return compact('author', 'books');
    }

} 