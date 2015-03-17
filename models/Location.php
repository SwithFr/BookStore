<?php

namespace Models;

use Models\Interfaces\LocationsRepositoryInterface;

class Location extends AppModel implements LocationsRepositoryInterface
{
    public $rules = [
        'name' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le nom est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Le nom doit être une chaine de caractère']
        ]
    ];

    /**
     * Récupère les les emplacements d'une bibliothèque
     * @param $user_id
     * @return array
     */
    public function getAllFromUserLibrary($user_id)
    {
        $sql = 'SELECT locations.id, locations.name
                FROM locations
                JOIN location_library ON location_id = locations.id
                JOIN libraries ON library_id = libraries.id
                WHERE libraries.user_id = :user_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':user_id' => $user_id]);

        return $pdost->fetchAll();
    }

    /**
     * @param $name
     * @param $library_id
     * @return mixed|void
     */
    public function create($name, $library_id)
    {
        $sql = 'INSERT INTO locations(name)
                VALUES (:name)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':name' => $name]);

        $this->newLocationLibrary($library_id, $this->db->lastInsertId());
    }

    /**
     * @param $library_id
     * @param $location_id
     * @return mixed|void
     */
    private function newLocationLibrary($library_id, $location_id)
    {
        $sql = 'INSERT INTO location_library(location_id, library_id)
                VALUES (:location_id,:library_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':library_id' => $library_id, ':location_id' => $location_id]);
    }
} 