<?php

namespace Controllers;

class AuthorsController extends AppController
{
    /**
     * PAGE LISTE AUTEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/', ucfirst($_GET['letter']))) {
            $letter = $_GET['letter'];
            $authors = $this->Author->getAllFromLetter("*", 'last_name', $letter);
        } else
            $this->redirect('index','author',['letter'=>'a']);

        return compact("authors", "letter");
    }

    public function add()
    {

    }

} 