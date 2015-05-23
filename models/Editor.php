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

    /**
     * Pagine les éditeurs pour la page "admin"
     * @param $nbpages
     * @param $nbperpage
     * @param $user_id
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $user_id)
    {
        if (!isset($_GET['page']) || $_GET['page'] < 1 || !is_numeric($_GET['page'])) {
            $_GET['page'] = 1;
        }

        if ($_GET['page'] > $nbpages && $nbpages != 0) {
            $_GET['page'] = $nbpages;
        }

        $sql = "SELECT id, name, website
                       FROM editors
                       WHERE user_id = $user_id
                       LIMIT " . $nbperpage * ($_GET['page'] - 1) . ',' . $nbperpage;
        $pdost = $this->db->prepare($sql);
        $pdost->execute();
        return $pdost->fetchAll();
    }


    /**
     * Récupère le nombre de livres d'un éditeur
     * @param $author_id
     * @return mixed
     */
    public function getBookCount($author_id)
    {
        $sql = 'SELECT COUNT(id) as count FROM books WHERE editor_id = :editor_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':editor_id' => $author_id]);

        return $pdost->fetch()->count;
    }

    /**
     * Mettre à jour un éditeur
     * @param $name
     * @param $website
     * @param $history
     * @param $img
     * @param $editor_id
     */
    public function update($name, $website, $history, $img, $editor_id)
    {
        $sql = 'UPDATE editors SET name = :name, website = :website, history = :history, img = :img WHERE id = :editor_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':name' => $name, ':website' => $website, ':history' => $history, ':img' => $img, ':editor_id' => $editor_id]);
    }
} 