<?php

namespace Controllers;

use Components\Request;
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
        $books = $this->Book->getWithGenre();
        $letters = [];
        $i = 0;
        foreach ($books as $book) {
            $letters[$book->name][$i] = $book->title;
            $i++;
        }

        return compact('letters');
    }
} 