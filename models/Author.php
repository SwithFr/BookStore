<?php


class Author extends AppModel
{
    /**
     * Permet de récupérer les X Auteurs les mieux notés
     * @param string $fields
     * @param int $limit
     * @return array
     */
    public function getPopular($fields, $limit)
    {
        $sql = 'SELECT ' . $fields . '
                FROM authors
                JOIN votes ON ref_id = authors.id
                JOIN author_book ON author_id = authors.id
                JOIN books ON book_id = books.id
                WHERE ref = \'authors\'
                ORDER BY value DESC
                LIMIT ' . $limit;
        $pdost = $this->db->query($sql);

        if ($limit > 1)
            return $pdost->fetchAll();

        return $pdost->fetch();
    }

} 