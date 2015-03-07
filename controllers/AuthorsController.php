<?php


class AuthorsController extends AppController
{
    /**
     * PAGE LISTE AUTEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/', ucfirst($_GET['letter']))) {
            $letter = $_GET['letter'];
            $authors = $this->Author->getAllFromLetter("*", $letter);
        } else
            header("Location: " . $_SERVER['PHP_SELF'] . '?a=index&e=author&letter=A');

        return compact("authors","letter");
    }

} 