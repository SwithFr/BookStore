<?php


namespace Controllers;


use Models\Interfaces\CommentsRepositoryInterface;

class CommentsController extends AppController
{
    function __construct(Request $request, CommentsRepositoryInterface $comment)
    {
        parent::__construct($request);
        $this->Comment = $comment;
    }

} 