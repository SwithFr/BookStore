<?php

namespace Models;

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

    public function create($title, $img, $summary, $isbn, $nbpages, $language_id, $genre_id, $location_id, $editor_id, $author_id, $library_id)
    {
        $sql = 'INSERT INTO books(title, img,summary, isbn, nbpages, language_id, genre_id, location_id, editor_id)
                VALUES (:title, :img, :summary, :isbn, :nbpages, :language_id, :genre_id, :location_id, :editor_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([
                ':title' => $title,
                ':img' => $img,
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

        $this->newBookLibrary($book_id, $library_id);
    }

    /**
     * Met à jour l'association dans la table author_book
     * @param $author_id
     * @param $book_id
     */
    private function updateAuthorBook($author_id, $book_id)
    {
        $sql = "UPDATE author_book
                SET author_id = $author_id
                WHERE book_id = $book_id";
        $this->db->query($sql);
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

    public function find($book_id)
    {
        $sql = 'SELECT books.id, title, books.img, summary, isbn, nbpages, language_id, genre_id, books.location_id, editor_id, author_id,
                       genres.name as g_name,
                       last_name, first_name, authors.id as a_id
                FROM books
                JOIN author_book ON book_id = books.id
                JOIN authors ON author_id = authors.id
                JOIN genres ON genre_id = genres.id
                JOIN locations ON location_id = locations.id
                JOIN languages ON books.language_id = languages.id
                JOIN editors ON books.editor_id = editors.id
                WHERE books.id=:book_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':book_id' => $book_id]);
        return $pdost->fetch();
    }

    public function update($data, $id)
    {
        $sql = 'UPDATE books
                SET title = :title, img = :img, summary = :summary, isbn = :isbn, nbpages = :nbpages,
                    language_id = :language_id, genre_id = :genre_id, location_id = :location_id, editor_id = :editor_id
                WHERE books.id = :id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute(
            [
                ':title' => $data['title'],
                ':img' => $data['img'],
                ':summary' => $data['summary'],
                ':isbn' => $data['isbn'],
                ':nbpages' => $data['nbpages'],
                ':language_id' => $data['language_id'],
                ':genre_id' => $data['genre_id'],
                ':location_id' => $data['location_id'],
                ':editor_id' => $data['editor_id'],
                ':id' => $id
            ]
        );

        $this->updateAuthorBook($data['author_id'],$id);
    }
}