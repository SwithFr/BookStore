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
    public function getPopular($fields, $limit);

    /**
     * Permet d'ajouter un auteur
     * @param $first_name
     * @param $last_name
     * @param $img
     * @param $date_birth
     * @param $date_death
     * @param $bio
     */
    public function create($first_name, $last_name, $img, $date_birth, $date_death, $bio);

    /**
     * @param $author_id
     * @return mixed
     */
    public function find($author_id);
} 