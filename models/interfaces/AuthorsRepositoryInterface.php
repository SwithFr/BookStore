<?php


namespace Models\Interfaces;


interface AuthorsRepositoryInterface
{
    /**
     * Permet de récupérer les X Auteurs les mieux notés
     * @param string $fields
     * @param int $limit
     * @return array
     */
    public function getPopular($fields, $limit = null);


    /**
     * Permet d'ajouter un auteur
     * @param $first_name
     * @param $last_name
     * @param $img
     * @param $date_birth
     * @param $date_death
     * @param $bio
     * @param $user_id
     */
    public function create($first_name, $last_name, $img, $date_birth, $date_death, $bio, $user_id);

    /**
     * Permet de récupérer un auteur selon son id
     * @param $author_id
     * @return mixed
     */
    public function findFromUser($author_id, $user_id);

    /**
     * Permet de récupérer les initiales des noms d'auteur
     * @return array
     */
    public function getLetters();

    /**
     * Récupère le nombre de livres d'un auteur
     * @param $author_id
     * @return mixed
     */
    public function getBookCount($author_id);

    /**
     * Pagine les auteurs pour la page "admin"
     * @param $nbpages
     * @param $nbperpage
     * @param $user_id
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $user_id);
}