<?php

namespace Controllers;

class GenresController extends AppController
{
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