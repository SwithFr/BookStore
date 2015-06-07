<?php


namespace Models\Interfaces;


interface LibrariesRepositoryInterface
{
    /**
     * Ajoute une librarie en base de données
     * @param $name
     * @param $address
     * @param $tel
     * @param $email
     * @param $user_id
     * @param $private
     */
    public function create($name, $address, $tel, $email, $user_id, $private);

    /**
     * Récupère la bibliothèque d'un utilisateur
     * @param $user_id
     * @return mixed
     */
    public function getFromUser($user_id);

    /**
     * Compte le nombre de livre dans une bibliothèque
     * @param $library_id
     * @return mixed
     */
    public function countBook($library_id);
} 