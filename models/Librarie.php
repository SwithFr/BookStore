<?php

namespace Models;

use Models\Interfaces\LibrariesRepositoryInterface;

class Librarie extends AppModel implements LibrariesRepositoryInterface
{
    public $table = 'libraries';

    public $rules = [
        'name' => [
            ['ruleName' => 'notEmpty', 'message' => 'Ce champ est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Doit être une chaine de caractère']
        ],
        'email' => [
            ['ruleName' => 'notEmpty', 'message' => 'Ce champ est obligatoire'],
            ['ruleName' => 'isMail', 'message' => 'Doit être un email valide']
        ]
    ];

    /**
     * Ajoute une librarie en base de données
     * @param $name
     * @param $adress
     * @param $tel
     * @param $email
     * @param $user_id
     * @param $private
     */
    public function create($name, $adress, $tel, $email, $user_id, $private)
    {
        $sql = 'INSERT INTO libraries(name,address,tel,email,user_id,private) VALUES (:name,:address,:tel,:email,:user_id,:private)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':name' => $name, ':address' => $adress, ':tel' => $tel, ':email' => $email, ':user_id' => $user_id, ':private' => intval($private)]);
    }

    /**
     * Récupère la bibliothèque d'un utilisateur
     * @param $user_id
     * @return mixed
     */
    public function getFromUser($user_id)
    {
        $sql = 'SELECT * FROM libraries WHERE user_id = :user_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':user_id' => $user_id]);

        return $pdost->fetch();
    }

} 