<?php


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

        $this->loadModel('Genre');
        $this->loadModel('Language');
        $this->loadModel('Editor');
        $this->loadModel('Location');
        $this->loadModel('Author');
        $genres = $this->Genre->get(['fields' => 'id,name']);
        $languages = $this->Language->get(['fields' => 'id,name']);
        $editors = $this->Editor->get(['fields' => 'id,name']);
        $locations = $this->Location->getAllFromUserLibrary($_SESSION['user_id']);
        $library_id = $locations[0]->l_id; # Plutot que de faire une nouvelle requete je récupère l'id directement depuis l'association avec la table locations
        $authors = $this->Author->get(['fields' => 'id,first_name,last_name','order'=>'last_name ASC']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $v = new Validator();
            if (!$v->validate($_POST, $this->Book->rules)) {
                $errors = $v->errors();
                Session::setFlash('Veuillez vérifier vos informations', 'error');
                return compact('genres', 'languages', 'editors', 'locations', 'authors', 'errors');
            }

            $this->Book->create(
                $_POST['title'],
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
        }

        return compact('genres', 'languages', 'editors', 'locations', 'authors');
    }

} 