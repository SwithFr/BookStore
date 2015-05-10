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
            $genre->book_count = $this->Book->count('genre_id = ' . $genre->id);
        }

        return compact('genres');
    }

    public function viex()
    {
        if (!$this->request->id) {
            $this->redirect('missingParams', 'error');
        }

        $genre = $this->Genre->find($_GET['id']);
        if(!$genre) {
            Session::setFlash('Cette catégorie n‘existe pas','error');
            $this->redirect('index','genre');
        }

        $genre->books =  $genre->books = $this->Book->getWithGenre($genre->id);

        return compact('genre');
    }
} 