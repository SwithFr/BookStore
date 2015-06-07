<?php

namespace Models\Interfaces;

interface BooksRepositoryInterface
{


    /**
     * Permet de récupérer les X livres les mieux notés
     * @param string $fields
     * @param int $limit
     * @return array|mixed
     */
    public function getPopular($fields, $limit = null);

    /**
     * Ajoute un livre
     * @param $title
     * @param $img
     * @param $summary
     * @param $isbn
     * @param $nbpages
     * @param $language_id
     * @param $genre_id
     * @param $location_id
     * @param $editor_id
     * @param $author_id
     * @param $library_id
     * @return mixed|void
     */
    public function create($title, $img, $summary, $isbn, $nbpages, $language_id, $genre_id, $location_id, $editor_id, $author_id, $library_id);

    /**
     * Récupère un livre selon son id
     * @param $book_id
     * @param bool $class
     * @return mixed
     */
    public function findBook($book_id, $class = false);

    /**
     * Met à jour les données d'un livre
     * @param $id
     * @param $data
     * @param null $table
     * @return bool|mixed|void
     */
    public function update($id, $data, $table = null);

    /**
     * Récupère un livre et son genre
     * @param $genre_id
     * @param null $limit
     * @return array
     */
    public function getWithGenre($genre_id, $limit = null);

    /**
     * Récupère les livres d'un autheur
     * @param $author_id
     * @return array
     */
    public function getAllFromAuthor($author_id);

    /**
     * Récupère les livres d'un éditeur
     * @param $editor_id
     * @return array
     */
    public function getAllFromEditor($editor_id);

    /**
     * Récupère la bibliothèque d'un livre
     * @param $book_id
     * @return mixed
     */
    public function getLibrary($book_id);

    /**
     * Supprime la liaison entre un livre et son auteur
     * @param $book_id
     */
    public function deleteRelations($book_id);

    /**
     * Pagine les auteurs pour la page "admin"
     * @param array $nbpages
     * @param $nbperpage
     * @param $library_id
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $library_id);

    /**
     * Savoir si un livre est déjà dans la liste de lecture
     * @param $user_id
     * @param $book_id
     * @return bool
     */
    public function alreadyInReadLater($user_id, $book_id);

    /**
     * Ajoute un livre à la liste de lecture
     * @param $user_id
     * @param $book_id
     */
    public function addReadLater($user_id, $book_id);

    /**
     * Supprime un livre de la liste de lecture
     * @param $user_id
     * @param $book_id
     */
    public function removeReadLater($user_id, $book_id);

    /**
     * Récupère tous les livres dans la liste de lecture d'un utilisateur
     * @param $user_id
     * @return array
     */
    public function getAllToRead($user_id);

} 