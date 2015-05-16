<?php

namespace Models;

use Models\Interfaces\EditorsRepositoryInterface;

class Editor extends AppModel implements EditorsRepositoryInterface
{
    public $rules = [
        'name' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le nom est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Le nom doit être une chaine de caractère']
        ]
    ];

    /**
     * Ajoute un éditeur
     * @param $name
     * @param string $website
     * @param string $img
     * @param string $history
     * @param $user_id
     */
    public function create($name, $website = '', $img = '', $history = '', $user_id)
    {
        $sql = 'INSERT INTO editors(name, website, img, history, user_id)
                VALUES (:name, :website, :img, :history, :user_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':name' => $name, ':website' => $website, ':img' => $img, ':history' => $history, ':user_id' => $user_id]);
    }

    /**
     * Permet de récupérer les initiales des noms des éditeurs
     * @return array
     */
    public function getLetters()
    {
        $sql = 'SELECT DISTINCT(LEFT(name,1)) AS letter FROM editors ORDER BY letter ASC';
        $pdost = $this->db->prepare($sql);
        $pdost->execute();
        $letters = [];
        foreach ($pdost->fetchAll(\PDO::FETCH_ASSOC) as $k => $v) {
            $letters[] = $v['letter'];
        }
        return $letters;
    }
} 