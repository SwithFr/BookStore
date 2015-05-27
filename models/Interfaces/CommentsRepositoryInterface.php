<?php


namespace Models\Interfaces;


interface CommentsRepositoryInterface
{
    /**
     * Ajoute un commentaire
     * @param $comment
     * @param $ref
     * @param $ref_id
     */
    public function create($comment, $ref, $ref_id);

    /**
     * Pagine les commentaires pour un livre
     * @param $nbpages
     * @param $nbperpage
     * @param $book_id
     * @param $ref
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $book_id, $ref);

    /**
     * Réduit le nombre de commentaire d'un utilisateur
     * @param $user_id
     */
    public function updateUserCount($user_id);
} 