<?php


class AuthorsController extends AppController
{
    /**
     * PAGE LISTE AUTEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/',ucfirst($_GET['letter'])))
            $authors = $this->Author->getAllFromLetter("*",$_GET['letter']);
        else 
            header("Location: "  . $_SERVER['PHP_SELF'] . '?a=index&e=author&letter=A');

        return compact("authors");
    }

} 