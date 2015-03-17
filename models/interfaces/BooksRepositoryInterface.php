<?php

namespace Models\Intfs;

interface BooksRepositoryInterface
{
    /**
     * @param $fields
     * @param null $limit
     * @return mixed
     */
    public function getPopular($fields, $limit = null);

    /**
     * @param $fields
     * @param $id
     * @param null $limit
     * @return mixed
     */
    public function getAllFromLibrary($fields, $id, $limit = null);

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
    public function find($book_id);

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id);

    /**
     * @return mixed
     */
    public function getWithGenre();

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