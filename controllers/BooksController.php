<?php

namespace Controllers;

use Carbon\Carbon;
use Components\Session;
use Components\Validator;
use Helpers\Image;

class BooksController extends AppController
{
    /**
     * PAGE D'ACCEUIL
     */
    public function index()
    {
        # Les 2 livres les mieux notés
        $books = $this->Book->getPopular('books.id,title,first_name,last_name,summary,books.img', 2);

        # l'auteur le mieux noté
        $this->loadModel('Author');
        $author = $this->Author->getPopular('authors.id,authors.img,first_name,last_name,bio,date_birth,date_death', 1);
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
     * Formulaire d'ajout de livre
     * @return array
     */
    public function edit()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged', 'error');

        if (!isset($_GET['library']))
            $this->redirect('missingParams', 'error');

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
        $library_id = $_GET['library'];
        $authors = $this->Author->get(['fields' => 'id,first_name,last_name', 'order' => 'last_name ASC']);
        $d = [];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $book = $this->Book->find($_GET['id']);
                $d['title'] = $book->title;
                $d['summary'] = $book->summary;
                $d['isbn'] = $book->isbn;
                $d['nbpages'] = $book->nbpages;
                $d['author_id'] = $book->author_id;
                $d['genre_id'] = $book->genre_id;
                $d['language_id'] = $book->language_id;
                $d['editor_id'] = $book->editor_id;
                $d['location_id'] = $book->location_id;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $d['title'] = $_POST['title'];
            $d['summary'] = $_POST['summary'];
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
                Image::uploadImg($dest, $name);
            } else {
                $dest = $name = '';
            }

            if (!isset($_GET['id'])) {
                $this->Book->create(
                    $d['title'],
                    $dest . $name,
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
                $d['img'] = $dest . $name;
                $this->Book->update($d, $_GET['id']);
                Session::setFlash('Le livre ' . $_POST['title'] . ' a bien été modifié !');
            }
            $this->redirect('account', 'user');
        }

        return compact('genres', 'languages', 'editors', 'locations', 'authors', 'library_id', 'd');
    }

    /**
     * Page d'un livre
     * @return array
     */
    public function view()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id']))
            $this->redirect('missingParams','error');

        $book = $this->Book->find($_GET['id']);
        if (!$book) {
            Session::setFlash('Le livre est introuvable !','error');
            $book = null;
        }

        return compact('book');
    }

    public function populars()
    {

    }

} 