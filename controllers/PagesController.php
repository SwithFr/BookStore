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
                        'get' => 'title, books.id'
                    ],
                    'authors' => [
                        'what' => $request,
                        'where' => ['last_name', 'first_name'],
                        'get' => 'first_name, last_name, id'
                    ],
                    'editors' => [
                        'what' => $request,
                        'where' => ['name'],
                        'get' => 'name, id'
                    ]
                ]
            );

            foreach ($data['books'] as $book) {
                $this->loadModel('Book');
                $library = $this->Book->getLibrary($book->id);
                $data['libraries'][$library->name]['id'] = $library->id;
                $data['libraries'][$library->name][] = $book;
            }

            unset($data['books']);
        }

        return compact('data', 'request');
    }
} 