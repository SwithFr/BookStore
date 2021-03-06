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
                GROUP BY title
                ORDER BY books.vote DESC ';
        if ($limit) {
            $sql .= 'LIMIT ' . $limit;
        }

        $pdost = $this->db->query($sql);
        $pdost->setFetchMode(\PDO::FETCH_CLASS, __NAMESPACE__ . "\\Entities\\BookEntity");
        if ($limit && $limit <= 1) {
            return $pdost->fetch();
        }
        return $pdost->fetchAll();
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
     * @param bool $class
     * @return mixed
     */
    public function findBook($book_id, $class = false)
    {
        $sql = 'SELECT books.id, title, books.img, summary, isbn, nbpages, language_id, genre_id, books.location_id, editor_id, books.vote,
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
        if ($class) {
            $pdost->setFetchMode(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\BookEntity');
        }
        return $pdost->fetch();
    }

    /**
     * Met à jour les données d'un livre
     * @param $id
     * @param $data
     * @param null $table
     * @return bool|mixed|void
     */
    public function update($id, $data, $table = null)
    {
        $author_id = $data->author_id;
        unset($data->author_id);

        parent::update($id, $data, $table);

        $this->updateAuthorBook($author_id, $id);
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
     * Récupère un livre et son genre
     * @param $genre_id
     * @param null $limit
     * @return array
     */
    public function getWithGenre($genre_id, $limit = null)
    {
        $sql = 'SELECT DISTINCT title, name, books.id, books.img, summary
                FROM books
                LEFT JOIN genres ON genre_id = genres.id
                WHERE genre_id = ' . $genre_id . '
                GROUP BY title
                ORDER BY name ASC';
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\BookEntity');
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
                WHERE authors.id = :author_id
                GROUP BY title';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':author_id' => $author_id]);
        return $pdost->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\BookEntity');
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
        return $pdost->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\BookEntity');
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

    /**
     * Pagine les auteurs pour la page "admin"
     * @param array $nbpages
     * @param $nbperpage
     * @param $library_id
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $library_id)
    {
        if (!isset($_GET['page']) || $_GET['page'] < 1 || !is_numeric($_GET['page'])) {
            $_GET['page'] = 1;
        }

        if ($_GET['page'] > $nbpages && $nbpages != 0) {
            $_GET['page'] = $nbpages;
        }

        $sql = "SELECT books.id, title, first_name, last_name, books.img, books.summary
                FROM books
                LEFT JOIN book_library ON book_library.book_id = books.id
                LEFT JOIN libraries ON book_library.library_id = libraries.id
                LEFT JOIN author_book ON author_book.book_id = books.id
                LEFT JOIN authors ON author_book.author_id = authors.id
                WHERE library_id = $library_id AND private = 0
                ORDER BY title ASC
                LIMIT " . $nbperpage * ($_GET['page'] - 1) . "," . $nbperpage;
        $pdost = $this->db->prepare($sql);
        $pdost->execute();
        return $pdost->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\BookEntity');
    }

    /**
     * Savoir si un livre est déjà dans la liste de lecture
     * @param $user_id
     * @param $book_id
     * @return bool
     */
    public function alreadyInReadLater($user_id, $book_id)
    {
        $sql = 'SELECT id FROM watch_later WHERE user_id = :user_id AND book_id = :book_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':user_id' => $user_id, ':book_id' => $book_id]);
        if($pdost->fetch()){
            return true;
        }
        return false;
    }

    /**
     * Ajoute un livre à la liste de lecture
     * @param $user_id
     * @param $book_id
     */
    public function addReadLater($user_id, $book_id)
    {
        $sql = 'INSERT INTO watch_later (user_id, book_id) VALUES (:user_id, :book_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':user_id' => $user_id, ':book_id' => $book_id]);
    }

    /**
     * Supprime un livre de la liste de lecture
     * @param $user_id
     * @param $book_id
     */
    public function removeReadLater($user_id, $book_id)
    {
        $sql = 'DELETE FROM watch_later WHERE user_id = :user_id AND book_id = :book_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':user_id' => $user_id, ':book_id' => $book_id]);
    }

    /**
     * Récupère tous les livres dans la liste de lecture d'un utilisateur
     * @param $user_id
     * @return array
     */
    public function getAllToRead($user_id)
    {
        $sql = 'SELECT books.id, title FROM books
                JOIN watch_later ON books.id = book_id
                WHERE user_id = ' . $user_id;
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\\Entities\\BookEntity');
    }

}