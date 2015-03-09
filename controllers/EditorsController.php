<?php


class EditorsController extends AppController
{
    /**
     * PAGE LISTE EDITEURS
     */
    public function index()
    {
        if (isset($_GET['letter']) && !empty($_GET['letter']) && preg_match('/[A-Z]/', ucfirst($_GET['letter']))) {
            $letter = $_GET['letter'];
            $editors = $this->Editor->getAllFromLetter("*", 'name', $letter);
        } else
            $this->redirect('index','author',['letter'=>'a']);

        return compact("editors", "letter");
    }
} 