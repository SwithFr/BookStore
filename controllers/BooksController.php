<?php


class BooksController extends AppController
{
    public function index()
    {
        # Les 2 livres les mieux notés
        $books = $this->Book->getPopular('books.id,title,first_name,last_name,summary,books.img',2);

        # l'auteur le mieux noté
        $this->loadModel('Author');
        $author = $this->Author->getPopular('first_name,last_name,bio,nb_livres,date_birth,date_death',1);

        return compact("books","author");
    }
} 