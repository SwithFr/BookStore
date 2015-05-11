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

    /**
     * Ajoute un commentaire
     * @param $comment
     * @param $ref
     * @param $ref_id
     */
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

        $sql = 'UPDATE users SET comment_count = comment_count + 1 WHERE id = ' . Session::getId();
        $this->db->query($sql);
    }

    /**
     * Pagine les commentaires pour un livre
     * @param $nbpages
     * @param $nbperpage
     * @param $book_id
     * @param $ref
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $book_id, $ref)
    {
        if (!isset($_GET['page']) || $_GET['page'] < 1 || !is_numeric($_GET['page'])) {
            $_GET['page'] = 1;
        }

        if ($_GET['page'] > $nbpages && $nbpages != 0) {
            $_GET['page'] = $nbpages;
        }

        $sql = "SELECT login, comment, user_id, ref, ref_id
                       FROM comments
                       JOIN users ON users.id = user_id
                       WHERE ref_id = $book_id AND ref = '$ref'
                       ORDER BY comments.id ASC
                       LIMIT " . $nbperpage * ($_GET['page'] - 1) . ',' . $nbperpage;
        $pdost = $this->db->prepare($sql);
        $pdost->execute();
        return $pdost->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\CommentEntity');
    }

    /**
     * Réduit le nombre de commentaire d'un utilisateur
     * @param $user_id
     */
    public function updateUserCount($user_id)
    {
        $sql = 'UPDATE users SET comment_count = comment_count - 1 WHERE id = ' . $user_id;
        $this->db->query($sql);
    }
} 