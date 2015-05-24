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
            $authors = $this->Author->getAllFromLetter("first_name,last_name,date_birth,date_death,bio,id", 'last_name', $letter, 'Author');
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
        if ($this->request->isPost()) {
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

            $this->Author->create($_POST['first_name'], $_POST['last_name'], $dest . $name, $_POST['date_birth'], $_POST['date_death'], $_POST['bio'], Session::getId());
            Session::setFlash('L‘auteur ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' a bien été ajouté !');
            $this->redirect('manage', 'author');
        }
    }

    /**
     * PAGE D'UN AUTEUR
     * @return array
     */
    public function view()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $author = $this->Author->find('id,last_name, first_name, img, date_birth, date_death, bio, vote', $_GET['id'], 'Author');
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
        $this->loadModel('Comment');
        $nbPerPage = 5;
        $nbPages = ceil($this->Comment->count('ref_id = ' . $author->id . ' AND ref = "author"') / $nbPerPage);
        $comments = $this->Comment->paginate($nbPages, $nbPerPage, $author->id, 'author');

        return compact('author', 'books', 'comments', 'nbPages');
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
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $author = $this->Author->find(null, $_GET['id'], 'Author', 'user_id = ' . Session::getId());
        if (!$author) {
            Session::setFlash('L‘auteur est introuvable !', 'error');
        }

        $errors = [];

        if ($this->request->isPost()) {
            $author->first_name = $_POST['first_name'];
            $author->last_name = $_POST['last_name'];
            $author->bio = $_POST['bio'];
            $author->date_birth = $_POST['date_birth'];
            $author->date_death = $_POST['date_death'];
            $v = new Validator();
            if ($v->validate($_POST, $this->Author->rules)) {
                if (!empty($_FILES['img']['name'])) {
                    $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                    $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'authors' . DS;
                    $author->img = $dest . $name;
                    Image::uploadImg($dest, $name);
                }
                $this->Author->update($author->id, $author);
                Session::setFlash('Les informations ont été modifiées avec succès !');
                $this->redirect('manage', 'author');
            } else {
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                $errors = $v->errors();
            }
        }

        return compact('author', 'errors');
    }

    /**
     * Confirmer une suppression
     * @return array
     */
    public function delete()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $author = $this->Author->find(null, $_GET['id'], 'Author', 'user_id = ' . Session::getId());

        if (!$author) {
            Session::setFlash('Vous ne pouvez supprimer cet auteur', 'error');
            $this->redirect('manage', 'author');
        }

        return compact('author');
    }

    /**
     * Supprimer un auteur
     */
    public function goDelete()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $this->Author->delete($_GET['id']);
        Session::setFlash('L‘auteur a bien été supprimé !');
        $this->redirect('manage', 'author');
    }

    /**
     * Gerer les auteurs que l'on a ajoutés
     * @return array
     */
    public function manage()
    {
        $nbPerPage = 5;
        $nbPages = ceil($this->Author->count('user_id = ' . Session::getId()) / $nbPerPage);
        $authors = $this->Author->paginate($nbPages, $nbPerPage, Session::getId());

        foreach ($authors as $a) {
            if ($this->Author->getBookCount($a->id) > 0) {
                $a->hasBooks = true;
            } else {
                $a->hasBooks = false;
            }
        }

        return compact('authors', 'nbPages');
    }

} 