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
        $author = $this->Author->getPopular('first_name,last_name,bio,nb_livres,date_birth,date_death', 1);
        $d_b =Carbon::parse($author->date_birth);
        $d_d =Carbon::parse($author->date_death);
        $author->date_birth = $d_b->year;
        $author->date_death = $d_d->year;


        return compact("books", "author");
    }

    /**
     * Formulaire d'ajout de livre
     * @return array
     */
    public function add()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged', 'error');

        if (!isset($_GET['library']))
            $this->redirect('missingParams','error');

        $this->loadModel('Genre');
        $this->loadModel('Language');
        $this->loadModel('Editor');
        $this->loadModel('Location');
        $this->loadModel('Author');
        $genres = $this->Genre->get(['fields' => 'id,name']);
        $languages = $this->Language->get(['fields' => 'id,name']);
        $editors = $this->Editor->get(['fields' => 'id,name']);
        $locations = $this->Location->getAllFromUserLibrary($_SESSION['user_id']);
        $library_id = $_GET['library']; # Plutot que de faire une nouvelle requete je récupère l'id directement depuis l'association avec la table locations
        $authors = $this->Author->get(['fields' => 'id,first_name,last_name', 'order' => 'last_name ASC']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Book->rules)) {
                $errors = $v->errors();
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                return compact('genres', 'languages', 'editors', 'locations', 'authors', 'errors','library_id');
            }

            if (!empty($_FILES['img']['name'])) {
                $name = time() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'books' . DS;
                Image::uploadImg($dest, $name);
            } else {
                $dest = $name = '';
            }

            $this->Book->create(
                $_POST['title'],
                $dest . $name,
                $_POST['summary'],
                $_POST['isbn'],
                $_POST['nbpages'],
                $_POST['language_id'],
                $_POST['genre_id'],
                $_POST['location_id'],
                $_POST['editor_id'],
                $_POST['author_id'],
                $library_id
            );

            Session::setFlash('Le livre ' . $_POST['title'] . ' a bien été ajouté !');
            $this->redirect('account', 'user');
        }

        return compact('genres', 'languages', 'editors', 'locations', 'authors','library_id');
    }

} 