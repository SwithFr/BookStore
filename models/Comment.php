<?php


namespace Models;


use Components\Session;
use Models\Interfaces\CommentsRepositoryInterface;

class Comment extends AppModel implements CommentsRepositoryInterface
{
    public $rules = [
        'text' => [
            ['ruleName'=>'notEmpty','message'=>'Veuillez saisir un commentaire']
        ]
    ];

    public function create($comment, $ref, $ref_id)
    {
        $sql = 'INSERT INTO comments (comment, ref, ref_id, user_id) VALUES (:comment, :ref, :ref_id, :user_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([
            ':comment' => $comment,
            ':ref' => $ref,
            ':ref_id' => $ref_id,
            ':user_id' => Session::getId()
        ]);

        $sql = 'UPDATE :ref SET comment_count = comment_count + 1 WHERE id = :ref_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([
            ':ref' => 'books',
            ':ref_id' => $ref_id
        ]);

        $sql = 'UPDATE users SET comment_count = comment_count + 1 WHERE id = ' . Session::getId();
        $this->db->query($sql);
    }
} 