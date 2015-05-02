<?php

namespace Models;

use Behaviors\searchable;
use Models\Interfaces\BooksRepositoryInterface;

class Book extends AppModel implements BooksRepositoryInterface
{
    use Searchable;

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
    public function getPopular($fields, $limit = null)
    {
        $sql = 'SELECT DISTINCT ' . $fields . '
                FROM books
                JOIN author_book ON book_id = books.id
                JOIN authors ON author_id = authors.id
                ORDER BY books.vote DESC ';
        if ($limit) {
            $sql .= 'LIMIT ' . $limit;
        }

        $pdost = $this->db->query($sql);

        return $pdost->fetchAll();
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
                LEFT JOIN book_library ON book_library.book_id = books.id
                LEFT JOIN libraries ON book_library.library_id = libraries.id
                LEFT JOIN author_book ON author_book.book_id = books.id
                LEFT JOIN authors ON author_book.author_id = authors.id
                WHERE library_id = ' . $id . ' AND private = 0
                ORDER BY title ASC ';

        if (!is_null($limit)) {
            $sql .= 'LIMIT ' . $limit;
        }

        $pdost = $this->db->query($sql);

        if ($limit > 1 || is_null($limit)) {
            return $pdost->fetchAll();
        }

        return $pdost->fetch();
    }

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

    /**
     * Récupère un livre selon son id
     * @param $book_id
     * @return mixed
     */
    public function find($book_id)
    {
        $sql = 'SELECT books.id, title, books.img, summary, isbn, nbpages, language_id, genre_id, books.location_id, editor_id,
                       genres.name AS g_name,
                       last_name, first_name, authors.id AS a_id, author_id,
                       editors.name AS e_name
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

    /**
     * Met à jour les données d'un livre
     * @param $data
     * @param $id
     * @return mixed|void
     */
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

        $this->updateAuthorBook($data['author_id'], $id);
    }

    /**
     * Récupère un livre et son genre
     * @return array
     */
    public function getWithGenre()
    {
        $sql = 'SELECT DISTINCT title, name, books.id, COUNT(books.id)
                FROM books
                JOIN genres ON genre_id = genres.id
                GROUP BY title
                ORDER BY name ASC';
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Récupère les livres d'un autheur
     * @param $author_id
     * @return array
     */
    public function getAllFromAuthor($author_id)
    {
        $sql = 'SELECT DISTINCT title, books.id
                FROM books
                JOIN author_book ON book_id = books.id
                JOIN authors ON author_id = authors.id
                WHERE authors.id = :author_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':author_id' => $author_id]);
        return $pdost->fetchAll();
    }

    /**
     * Récupère les livres d'un éditeur
     * @param $editor_id
     * @return array
     */
    public function getAllFromEditor($editor_id)
    {
        $sql = 'SELECT DISTINCT title, books.id, history
                FROM books
                JOIN editors ON editor_id = editors.id
                WHERE editor_id = :editor_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':editor_id' => $editor_id]);
        return $pdost->fetchAll();
    }

    /**
     * Récupère la bibliothèque d'un livre
     * @param $book_id
     * @return mixed
     */
    public function getLibrary($book_id)
    {
        $sql = 'SELECT name, libraries.id
                FROM libraries
                JOIN book_library ON library_id = libraries.id
                WHERE book_id = :book_id AND private = 0';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':book_id' => $book_id]);
        return $pdost->fetch();
    }

    /**
     * Supprime la liaison entre un livre et son auteur
     * @param $book_id
     */
    public function deleteRelations($book_id)
    {
        $sql = 'DELETE FROM author_book WHERE book_id = ' . $book_id;
        $this->db->query($sql);

        $sql = 'DELETE FROM book_library WHERE book_id = ' . $book_id;
        $this->db->query($sql);
    }

}