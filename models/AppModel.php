<?php

namespace Models;

use Components\DbProvider;

class AppModel
{
    /**
     * La connexion PDO
     * @var null|PDO
     */
    protected $db = null;

    /**
     * Le nom de la table
     * @var null|string
     */
    protected $table = null;

    function __construct()
    {
        if (is_null($this->db))
            $this->db = DbProvider::getDb();

        $this->table = str_replace('models\\', '', strtolower(get_class($this))) . 's';
    }

    /**
     * Permet de récupérer des infos depuis la bdd
     * @param array $conditions
     * @return array
     */
    public function get(array $conditions = null)
    {

        $query = "SELECT ";

        // Si on a des champs définis
        if (!isset($conditions['fields']))
            $query .= "*";
        else
            $query .= $conditions['fields'];


        $query .= " FROM " . $this->table;

        // Si on a un Where
        if (isset($conditions['where'])) {
            if (!is_array($conditions['where'])) {
                $query .= " WHERE " . $conditions['where'];
            } else {
                $query .= " WHERE ";
                $cond = [];
                foreach ($conditions['where'] as $k => $v) {
                    if (!is_numeric($v))
                        $v = "'" . addslashes($v) . "'";
                    $cond[] = "$k=$v";
                }
                $query .= implode(' AND ', $cond);
            }
        }

        // Si on a une limite
        if (isset($conditions['limit'])) {
            if (isset($conditions['offset'])) {
                $query .= " LIMIT " . $conditions['offset'] . "," . $conditions['limit'];
            } else {
                $query .= " LIMIT " . $conditions['limit'];
            }

        }

        // Si on a un group by
        if (isset($conditions['groupBy'])) {
            $query .= " GROUP BY " . $conditions['groupBy'];
        }

        // Si on a un order
        if (isset($conditions['order'])) {
            $query .= " ORDER BY " . $conditions['order'];
        }

        // debug($query);
        $req = $this->db->query($query);

        return $req->fetchAll();
    }

    /**
     * Permet de récupérer la liste des entité dont le $search commence par $letter
     * @param string $fields
     * @param string $search
     * @param string $letter
     * @return array
     */
    public function getAllFromLetter($fields, $search, $letter)
    {
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE ' . $search . ' LIKE \'' . $letter . '%\'';
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll();
    }

    /**
     * Permet de récupérer les données d'une entrée selon son id
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id=:id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':id' => $id]);

        return $pdost->fetch();
    }

} 