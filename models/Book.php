<?php


class Book extends AppModel
{
    /**
     * Permet de récupérer les X livres les mieux notés
     * @param string $fields
     * @param int $limit
     * @return array|mixed
     */
    public function getPopular($fields, $limit)
    {
        $sql = 'SELECT ' . $fields . '
                FROM books
                JOIN votes ON ref_id = books.id
                JOIN author_book ON book_id = books.id
                JOIN authors ON author_id = authors.id
                WHERE ref = \'books\'
                ORDER BY value DESC
                LIMIT ' . $limit;
        $pdost = $this->db->query($sql);

        if ($limit > 1)
            return $pdost->fetchAll();

        return $pdost->fetch();
    }

    /**
     * Permet de récupérer tous les livres d'une bibliotèque
     * @param string $fields
     * @param int $id
     * @param int $limit
     * @return array|mixed
     */
    public function getAllFromLibrary($fields, $id, $limit = null)
    {
        $sql = 'SELECT ' . $fields . '
                FROM books
                JOIN book_library ON book_library.book_id = books.id
                JOIN libraries ON book_library.library_id = libraries.id
                JOIN author_book ON author_book.book_id = books.id
                JOIN authors ON author_book.author_id = authors.id
                WHERE library_id = ' . $id . '
                ORDER BY title ASC ';

        if (!is_null($limit))
            $sql .= 'LIMIT ' . $limit;
        
        $pdost = $this->db->query($sql);

        if ($limit > 1 || is_null($limit))
            return $pdost->fetchAll();

        return $pdost->fetch();
    }
}