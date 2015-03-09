<?php


class Book extends AppModel
{
    public $rules = [
        'title' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le titre est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Le titre doit être une chaine de caractère']
        ],
        'summary' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le résumé est obligatoire']
        ],
        'nbpages' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le nombre de pages est obligatoire'],
            ['ruleName' => 'isInt', 'message' => 'Ceci n‘est pas un nombre']
        ],
        'genre_id' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le genre est obligatoire'],
            ['ruleName' => 'isInt', 'message' => 'La valeur n‘est pas valide']
        ],
        'language_id' => [
            ['ruleName' => 'notEmpty', 'message' => 'La langue est obligatoire'],
            ['ruleName' => 'isInt', 'message' => 'La valeur n‘est pas valide']
        ],
        'editor_id' => [
            ['ruleName' => 'notEmpty', 'message' => 'L‘editeur est obligatoire'],
            ['ruleName' => 'isInt', 'message' => 'La valeur n‘est pas valide']
        ],
        'location_id' => [
            ['ruleName' => 'notEmpty', 'message' => 'L‘emplacement est obligatoire'],
            ['ruleName' => 'isInt', 'message' => 'La valeur n‘est pas valide']
        ],
        'author_id' => [
            ['ruleName' => 'notEmpty', 'message' => 'L‘auteur est obligatoire'],
            ['ruleName' => 'isInt', 'message' => 'La valeur n‘est pas valide']
        ]
    ];

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

    public function create($title, $summary, $isbn, $nbpages, $language_id, $genre_id, $location_id, $editor_id, $author_id, $library_id)
    {
        $sql = 'INSERT INTO books(title, summary, isbn, nbpages, language_id, genre_id, location_id, editor_id)
                VALUES (:title, :summary, :isbn, :nbpages, :language_id, :genre_id, :location_id, :editor_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([
                ':title' => $title,
                ':summary' => $summary,
                ':isbn' => $isbn,
                ':nbpages' => $nbpages,
                ':language_id' => $language_id,
                ':genre_id' => $genre_id,
                ':location_id' => $location_id,
                ':editor_id' => $editor_id]
        );

        $this->newAuthorBook($author_id, $this->db->lastInsertId(), $library_id);
    }

    /**
     * Ajoute l'association dans la table author_book
     * @param $author_id
     * @param $book_id
     * @param $library_id
     */
    private function newAuthorBook($author_id, $book_id, $library_id)
    {
        $sql = "INSERT INTO author_book(author_id, book_id)
                VALUES ($author_id,$book_id)";
        $this->db->query($sql);

        $this->newBookLibrary($book_id,$library_id);
    }

    /**
     * Ajoute l'association dans la table book_library
     * @param $book_id
     * @param $library_id
     */
    private function newBookLibrary($book_id, $library_id)
    {
        $sql = "INSERT INTO book_library(book_id,library_id)
                VALUES ($book_id,$library_id)";
        $this->db->query($sql);
    }
}