<?php


class ErrorsController extends AppController
{
    public function unauthorized()
    {
        $this->layout = 'error';
        $message = "Hey bonhomme ! Je te conseille de pas aller plus loin...";
        return compact('message');
    }

} 