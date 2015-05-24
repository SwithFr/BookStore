<?php

namespace Controllers;

use Components\Request;
use Components\Session;
use Models\Interfaces\GenresRepositoryInterface;

class GenresController extends AppController
{
    function __construct(GenresRepositoryInterface $genre, Request $request)
    {
        parent::__construct($request);
        $this->Genre = $genre;
    }

    /**
     * Liste tous les genres
     * @return array
     */
    public function index()
    {
        $this->loadModel('Book');
        $genres = $this->Genre->get();
        foreach ($genres as $genre) {
            $genre->books = $this->Book->getWithGenre($genre->id, 5);
        }

        return compact('genres');
    }

    /**
     * Affiche les livres d'un genre
     * @return array
     */
    public function view()
    {
        if (!$this->request->id) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $genre = $this->Genre->find(null, $_GET['id']);
        if (!$genre) {
            Session::setFlash('Cette catégorie n‘existe pas', 'error');
            $this->redirect('index', 'genre');
        }

        $this->loadModel('Book');
        $genre->books = $genre->books = $this->Book->getWithGenre($genre->id);

        return compact('genre');
    }
} 