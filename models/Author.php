<?php

namespace Models;

class Author extends AppModel
{
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
                JOIN votes ON ref_id = authors.id
                LEFT JOIN author_book ON author_id = authors.id
                LEFT JOIN books ON book_id = books.id
                WHERE ref = \'authors\'
                ORDER BY value DESC
                LIMIT ' . $limit;
        $pdost = $this->db->query($sql);

        if ($limit > 1)
            return $pdost->fetchAll();

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

    public function find($author_id)
    {
        $sql = 'SELECT id,last_name, first_name, img, date_birth, date_death, bio
                FROM authors
                WHERE id=:author_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':author_id' => $author_id]);
        return $pdost->fetch();
    }
}