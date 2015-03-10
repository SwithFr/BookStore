<?php

namespace Models;

class Editor extends AppModel
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
     */
    public function create($name, $website = '', $img = '', $history = '')
    {
        $sql = 'INSERT INTO editors(name, website, img, history)
                VALUES (:name, :website, :img, :history)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':name' => $name, ':website' => $website, ':img' => $img, ':history' => $history]);
    }
} 