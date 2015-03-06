<?php


class Book extends AppModel
{
    /**
     * Permet de récupérer les X entités les plus populaires
     * @param string $fields
     * @param int $limit
     * @return array
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
        var_dump($sql);die();
        $pdost = $this->db->query($sql);

        if ($limit > 1)
            return $pdost->fetchAll();

        return $pdost->fetch();
    }
}