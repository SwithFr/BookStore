<?php


namespace Controllers;


class PagesController extends AppController
{
    public $noModel = true;

    public function index()
    {
        $this->redirect('index','book');
    }

    public function searchAll()
    {
        $this->loadModel('AppModel');
        $this->AppModel->searchAll(
            [
                'books' => [
                    'what' => 'Harry',
                    'where'=> ['title','summary'],
                    'get'  => 'title'
                ],
                'authors' => [
                    'what' => 'Rolling',
                    'where'=> ['last_name'],
                    'get'  => 'first_name'
                ]
            ]
        );
    }
} 