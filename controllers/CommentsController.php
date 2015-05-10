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

    public function add($ref, $ref_id)
    {

    }

    public function delete($ref, $ref_id)
    {

    }

} 