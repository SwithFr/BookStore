<?php

namespace Controllers;

use Behaviors\Votable;
use Carbon\Carbon;
use Components\Request;
use Components\Session;
use Components\Validator;
use Helpers\Image;
use Models\Interfaces\BooksRepositoryInterface;

class BooksController extends AppController
{
    function __construct(BooksRepositoryInterface $book, Request $request)
    {
        parent::__construct($request);
        $this->Book = $book;
    }

    /**
     * PAGE D'ACCEUIL
     */
    public function index()
    {
        # Les 2 livres les mieux notés
        $books = $this->Book->getPopular('books.id,title,first_name,last_name,summary,books.img', 2);

        # l'auteur le mieux noté
        $this->loadModel('Author');
        $author = $this->Author->getPopular('authors.id,authors.img,first_name,last_name,bio,date_birth,date_death,authors.vote', 1);
        $author->book_count = $this->Author->getBookCount($author->id);
        $d_b = Carbon::parse($author->date_birth);
        $author->date_birth = $d_b->year;
        if ($author->date_death != '0000-00-00') {
            $d_d = Carbon::parse($author->date_death);
            $author->date_death = $d_d->year;
        } else {
            $author->date_death = '';
        }

        return compact("books", "author");
    }

    /**
     * Formulaire d'ajout et édition de livre
     * @return array
     */
    public function edit()
    {
        if (!$this->request->checkParams(['library' => 'id'])) {
            $this->redirect('missingParams', 'error');
        }

        $this->loadModel('Genre');
        $this->loadModel('Language');
        $this->loadModel('Editor');
        $this->loadModel('Location');
        $this->loadModel('Author');
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_COOKIE['user_id'];
        $genres = $this->Genre->get(['fields' => 'id,name']);
        $languages = $this->Language->get(['fields' => 'id,name']);
        $editors = $this->Editor->get(['fields' => 'id,name']);
        $locations = $this->Location->getAllFromUserLibrary($user_id);
        if (!$locations) {
            Session::setFlash('Vous n‘avez pas d‘emplacement pour cette bibliothèque ! Ajoutez en un avant d‘ajouter un livre', 'error');
            $this->redirect('manage', 'librarie');
        }
        $library_id = $_GET['library'];
        $authors = $this->Author->get(['fields' => 'id,first_name,last_name', 'order' => 'last_name ASC']);
        $d = [];

        if ($this->request->isGet()) {
            if ($this->request->id) {
                $book = $this->Book->findBook($_GET['id']);
                $d['title'] = $book->title;
                $d['summary'] = $book->summary;
                $d['img'] = $book->img;
                $d['isbn'] = $book->isbn;
                $d['nbpages'] = $book->nbpages;
                $d['author_id'] = $book->author_id;
                $d['genre_id'] = $book->genre_id;
                $d['language_id'] = $book->language_id;
                $d['editor_id'] = $book->editor_id;
                $d['location_id'] = $book->location_id;
            }
        }

        if ($this->request->isPost()) {
            $d['title'] = $_POST['title'];
            $d['summary'] = $_POST['summary'];
            $d['img'] = $_POST['img'];
            $d['isbn'] = $_POST['isbn'];
            $d['nbpages'] = $_POST['nbpages'];
            $d['author_id'] = $_POST['author_id'];
            $d['genre_id'] = $_POST['genre_id'];
            $d['language_id'] = $_POST['language_id'];
            $d['editor_id'] = $_POST['editor_id'];
            $d['location_id'] = $_POST['location_id'];

            $v = new Validator();
            if (!$v->validate($d, $this->Book->rules)) {
                $errors = $v->errors();
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                return compact('genres', 'languages', 'editors', 'locations', 'authors', 'errors', 'library_id', 'd');
            }

            if (!empty($_FILES['img']['name'])) {
                $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'books' . DS;
                $d['img'] = $dest . $name;
                Image::uploadImg($dest, $name);
            }

            if (!isset($_GET['id'])) {
                $this->Book->create(
                    $d['title'],
                    $d['img'],
                    $d['summary'],
                    $d['isbn'],
                    $d['nbpages'],
                    $d['language_id'],
                    $d['genre_id'],
                    $d['location_id'],
                    $d['editor_id'],
                    $d['author_id'],
                    $library_id
                );

                Session::setFlash('Le livre ' . $_POST['title'] . ' a bien été ajouté !');
            } elseif (is_numeric($_GET['id'])) {
                $this->Book->update($d, $_GET['id']);
                Session::setFlash('Le livre ' . $_POST['title'] . ' a bien été modifié !');
            }
            $this->redirect('manage', 'librarie');
        }

        return compact('genres', 'languages', 'editors', 'locations', 'authors', 'library_id', 'd');
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

        $book = $this->Book->findBook($_GET['id']);

        if (!$book) {
            Session::setFlash('Ce livre est introuvable', 'error');
            $this->redirect('manage', 'librarie');
        }

        return compact('book');
    }

    /**
     * Supprimer un livre
     */
    public function goDelete()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $this->Book->delete($_GET['id']);
        $this->Book->deleteRelations($_GET['id']);
        Session::setFlash('Le livre a bien été supprimé !');
        $this->redirect('manage', 'librarie');
    }

    /**
     * Page d'un livre
     * @return array
     */
    public function view()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $book = $this->Book->findBook($_GET['id'], true);
        if (!$book) {
            Session::setFlash('Le livre est introuvable !', 'error');
            $book = null;
        }

        $book->isReadLater = $this->Book->alreadyInReadLater(Session::getId(), $book->id);

        $this->loadModel('Comment');
        $nbPerPage = 5;
        $nbPages = ceil($this->Comment->count('ref_id = ' . $book->id . ' AND ref = "book"') / $nbPerPage);
        $comments = $this->Comment->paginate($nbPages, $nbPerPage, $book->id, 'book');

        return compact('book', 'comments', 'nbPages');
    }

    /**
     * Affiche le classement des livres et des auteurs
     * @return array
     */
    public function populars()
    {
        $books = $this->Book->getPopular('books.id,title,books.vote', 10);
        $this->loadModel('Author');
        $authors = $this->Author->getPopular('authors.id,first_name,last_name,authors.vote', 10);
        return compact('books', 'authors');
    }

    /**
     * Aimer un livre
     */
    public function voteUp()
    {
        $v = new Votable();
        $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : $_SESSION['user_id'];
        $v->vote('books', $_GET['ref_id'], $user_id, 1);
        $this->redirect('view', 'book', ['id' => $_GET['ref_id']]);
    }

    /**
     * ne pas aimer un livre
     */
    public function voteDown()
    {
        $v = new Votable();
        $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : $_SESSION['user_id'];
        $v->vote('books', $_GET['ref_id'], $user_id, -1);
        $this->redirect('view', 'book', ['id' => $_GET['ref_id']]);
    }

    /**
     * Ajouter un livre à lire plus tard
     * [AJAX]
     */
    public function addToReadLater()
    {
        $this->layout = 'empty';
        if (!isset($_POST['user_id']) || !isset($_POST['book_id'])) {
            return false;
        }

        if (!$this->Book->alreadyInReadLater($_POST['user_id'], $_POST['book_id'])) {
            $this->Book->addReadLater($_POST['user_id'], $_POST['book_id']);
        }
    }

    /**
     * Supprimer un livre de lire plus tard
     * [AJAX]
     */
    public function removeToReadLater()
    {
        $this->layout = 'empty';
        if (!isset($_POST['user_id']) || !isset($_POST['book_id'])) {
            return false;
        }

        $this->Book->removeReadLater($_POST['user_id'], $_POST['book_id']);
    }

    /**
     * Affiche la liste de lecture
     */
    public function readLater()
    {
        $readLaterBooks = $this->Book->getAllToRead(Session::getId());

        if(!$readLaterBooks) {
            Session::setFlash('Vous n‘avez pas encore de livre dans votre liste de lecture !','error');
            $this->redirect('index','user');
        }

        return compact('readLaterBooks');
    }

} 