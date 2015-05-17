<?php

namespace Models\Interfaces;

interface BooksRepositoryInterface
{
    /**
     * @param $fields
     * @param null $limit
     * @return mixed
     */
    public function getPopular($fields, $limit = null);

    /**
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
     * @return mixed
     */
    public function create($title, $img, $summary, $isbn, $nbpages, $language_id, $genre_id, $location_id, $editor_id, $author_id, $library_id);

    /**
     * @param $book_id
     * @return mixed
     */
    public function findBook($book_id);

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id);

    /**
     * @return mixed
     */
    public function getWithGenre($genre_id);

    /**
     * @param $author_id
     * @return mixed
     */
    public function getAllFromAuthor($author_id);

    /**
     * @param $book_id
     * @return mixed
     */
    public function getLibrary($book_id);

} 