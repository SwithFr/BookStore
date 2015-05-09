<?php

namespace Controllers;

use Behaviors\Votable;
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
            $letters = $this->Author->getLetters();
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
        } else {
            $this->redirect('index', 'author', ['letter' => 'a']);
        }

        return compact("authors", "letter", "letters");
    }

    /**
     * AJOUT D'UN AUTEUR
     */
    public function add()
    {
        if (!Session::isLogged()) {
            $this->redirect('notLogged', 'error');
        }

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

            if (empty($_POST['date_death'])) {
                $_POST['date_death'] = '0000-00-00';
            }

            $this->Author->create($_POST['first_name'], $_POST['last_name'], $dest . $name, $_POST['date_birth'], $_POST['date_death'], $_POST['bio']);
            Session::setFlash('L‘auteur ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' a bien été ajouté !');
            $this->redirect('account', 'user');
        }
    }

    /**
     * PAGE D'UN AUTEUR
     * @return array
     */
    public function view()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirect('missingParams', 'error');
        }

        $author = $this->Author->find($_GET['id']);
        if (!$author) {
            Session::setFlash('L‘auteur est introuvable !', 'error');
        }

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

    /**
     * Rechercher un auteur
     * @return array
     */
    public function search()
    {
        $authors = $request = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && !empty($_POST['search'])) {
            $request = $_POST['search'];
            $authors = $this->Author->search($request, ['last_name', 'first_name'], 'first_name, last_name, id');
        }

        return compact('authors', 'request');
    }

    /**
     * Aimer un auteur
     */
    public function voteUp()
    {
        $v = new Votable();
        $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : $_SESSION['user_id'];
        $v->vote('authors', $_GET['ref_id'], $user_id, 1);
        $this->redirect('view', 'author', ['id' => $_GET['ref_id']]);
    }

    /**
     * ne pas aimer un auteur
     */
    public function voteDown()
    {
        $v = new Votable();
        $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : $_SESSION['user_id'];
        $v->vote('authors', $_GET['ref_id'], $user_id, -1);
        $this->redirect('view', 'author', ['id' => $_GET['ref_id']]);
    }

    /**
     * Editer un auteur
     */
    public function edit()
    {
        if (!Session::isLogged()) {
            $this->redirect('notLogged', 'error');
        }

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirect('missingParams', 'error');
        }

        $author = $this->Author->find($_GET['id'], Session::getId());
        if (!$author) {
            Session::setFlash('L‘auteur est introuvable !', 'error');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if ($v->validate($_POST, $this->Author->rules)) {
                $author->first_name = $_POST['first_name'];
                $author->last_name = $_POST['last_name'];
                $author->bio = $_POST['bio'];
                $author->date_birth = $_POST['date_birth'];
                $author->date_death = $_POST['date_death'];
                if (!empty($_FILES['img']['name'])) {
                    $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                    $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'authors' . DS;
                    $img = $dest . $name;
                    Image::uploadImg($dest, $name);
                } else {
                    $img = $author->img;
                }
                $this->Author->update($_POST['first_name'], $_POST['last_name'], $_POST['bio'], $_POST['date_birth'], $_POST['date_death'], $img, $author->id);
                Session::setFlash('Les informations ont été modifiées avec succès !');
            } else {
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                $errors = $v->errors();
            }
        }

        return compact('author', 'errors');

    }

} 