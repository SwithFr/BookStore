<?php

namespace Models;

use Behaviors\Searchable;
use Models\Interfaces\AuthorsRepositoryInterface;

class Author extends AppModel implements AuthorsRepositoryInterface
{

    use Searchable;

    public $rules = [
        'first_name' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le prénom est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Le prénom doit être une chaine de caractère']
        ],
        'last_name' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le nom est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Le nom doit être une chaine de caractère']
        ],
        'bio' => [
            ['ruleName' => 'notEmpty', 'message' => 'La biographie est obligatoire']
        ],
        'date_birth' => [
            ['ruleName' => 'notEmpty', 'message' => 'La date de naissance est obligatoire'],
            ['ruleName' => 'isDate', 'message' => 'La valeur n‘est pas valide']
        ],
        'date_death' => [
            ['ruleName' => 'isDate', 'message' => 'La valeur n‘est pas valide']
        ]
    ];

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
                LEFT JOIN author_book ON author_id = authors.id
                LEFT JOIN books ON book_id = books.id
                ORDER BY vote DESC
                LIMIT ' . $limit;
        $pdost = $this->db->query($sql);

        if ($limit > 1) {
            return $pdost->fetchAll();
        }

        return $pdost->fetch();
    }

    /**
     * Permet d'ajouter un auteur
     * @param $first_name
     * @param $last_name
     * @param $img
     * @param $date_birth
     * @param $date_death
     * @param $bio
     */
    public function create($first_name, $last_name, $img, $date_birth, $date_death, $bio)
    {
        $sql = 'INSERT INTO authors(first_name, last_name, img, date_birth, date_death, bio)
                VALUES (:first_name, :last_name, :img, :date_birth, :date_death, :bio)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':first_name' => $first_name, ':last_name' => $last_name, ':img' => $img, ':date_birth' => $date_birth, ':date_death' => $date_death, ':bio' => $bio]);
    }

    /**
     * Permet de récupérer un auteur selon son id
     * @param $author_id
     * @return mixed
     */
    public function find($author_id)
    {
        $sql = 'SELECT id,last_name, first_name, img, date_birth, date_death, bio, vote
                FROM authors
                WHERE id=:author_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':author_id' => $author_id]);
        return $pdost->fetch();
    }

    /**
     * Permet de récupérer un auteur selon son id
     * @param $author_id
     * @return mixed
     */
    public function findFromUser($author_id, $user_id)
    {
        $sql = 'SELECT id,last_name, first_name, img, date_birth, date_death, bio, vote
                FROM authors
                WHERE id=:author_id AND user_id = :user_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':author_id' => $author_id, ':user_id' => $user_id]);
        return $pdost->fetch();
    }

    /**
     * Permet de récupérer les initiales des noms d'auteur
     * @return array
     */
    public function getLetters()
    {
        $sql = 'SELECT DISTINCT(LEFT(last_name,1)) AS letter FROM authors ORDER BY letter ASC';
        $pdost = $this->db->prepare($sql);
        $pdost->execute();
        $letters = [];
        foreach ($pdost->fetchAll(\PDO::FETCH_ASSOC) as $k => $v) {
            $letters[] = $v['letter'];
        }
        return $letters;
    }

    /**
     * Récupère le nombre de livres d'un auteur
     * @param $author_id
     * @return mixed
     */
    public function getBookCount($author_id)
    {
        $sql = 'SELECT COUNT(id) as count FROM author_book WHERE author_id = :author_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':author_id' => $author_id]);

        return $pdost->fetch()->count;
    }

    /**
     * Met à jour un auteur
     * @param $first_name
     * @param $last_name
     * @param $bio
     * @param $date_birth
     * @param $date_death
     * @param $img
     * @param $author_id
     */
    public function update($first_name, $last_name, $bio, $date_birth, $date_death, $img, $author_id)
    {
        $sql = 'UPDATE authors SET first_name = :first_name, last_name = :last_name, bio = :bio, date_birth = :date_birth, date_death = :date_death, img = :img WHERE id = ' . $author_id;
        $pdost = $this->db->prepare($sql);
        $pdost->execute(['first_name' => $first_name, 'last_name' => $last_name, 'bio' => $bio, 'date_birth' => $date_birth, 'date_death' => $date_death, 'img' => $img]);
    }

    /**
     * Pagine les auteurs pour la page "admin"
     * @param $nbpages
     * @param $nbperpage
     * @param $user_id
     * @return array
     */
    public function paginateForAccount($nbpages, $nbperpage, $user_id)
    {
        if (!isset($_GET['page']) || $_GET['page'] < 1 || !is_numeric($_GET['page'])) {
            $_GET['page'] = 1;
        }

        if ($_GET['page'] > $nbpages) {
            $_GET['page'] = $nbpages;
        }

        $sql = "SELECT id, first_name, last_name
                       FROM authors
                       WHERE user_id = $user_id
                       LIMIT " . $nbperpage * ($_GET['page'] - 1) . ',' . $nbperpage;
        $pdost = $this->db->prepare($sql);
        $pdost->execute();
        return $pdost->fetchAll();
    }
}