<?php


namespace Controllers;


class PagesController extends AppController
{
    public $noModel = true;

    /**
     * Renvoi la page d'accueil
     */
    public function index()
    {
        $this->redirect('index', 'book');
    }

    /**
     * Formulaire de recherche général
     * @return array
     */
    public function searchAll()
    {
        $data = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request = $_POST['search'];

            $this->loadModel('AppModel');
            $data = $this->AppModel->searchAll(
                [
                    'books' => [
                        'what' => $request,
                        'where' => ['title', 'summary'],
                        'get' => 'title, id'
                    ],
                    'authors' => [
                        'what' => $request,
                        'where' => ['last_name'],
                        'get' => 'first_name, last_name, id'
                    ],
                    'genres' => [
                        'what' => $request,
                        'where' => ['name'],
                        'get' => 'name, id'
                    ]
                ]
            );
        }

        return compact('data', 'request');
    }
} 