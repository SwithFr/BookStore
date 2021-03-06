<?php

namespace Models;

use Behaviors\Searchable;
use Components\DbProvider;
use Models\Entities;

class AppModel
{
    use Searchable;

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
        if (!isset($conditions['fields'])) {
            $query .= "*";
        } else {
            $query .= $conditions['fields'];
        }


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
    public function getAllFromLetter($fields, $search, $letter, $class = false)
    {
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE ' . $search . ' LIKE \'' . $letter . '%\'';
        $pdost = $this->db->query($sql);
        if ($class) {
            $className = __NAMESPACE__ . "\\Entities\\" . $class . "Entity";
            return $pdost->fetchAll(\PDO::FETCH_CLASS, $className);
        }
        return $pdost->fetchAll();
    }

    /**
     * Permet de récupérer les données d'une entrée selon son id
     * @param null $fields
     * @param $id
     * @param bool $class
     * @param null $otherCondition
     * @return mixed
     */
    public function find($fields = null, $id, $class = false, $otherCondition = null)
    {
        if (is_null($fields)) {
            $fields = '*';
        }
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE id=:id';

        if ($otherCondition) {
            $sql .= ' AND ' . $otherCondition;
        }
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':id' => $id]);
        if ($class) {
            $pdost->setFetchMode(\PDO::FETCH_CLASS, __NAMESPACE__ . "\\Entities\\" . $class . "Entity");
        }
        return $pdost->fetch();
    }

    /**
     * Supprime un enregistrement
     * @param $id
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $id;
        $this->db->query($sql);
    }

    /**
     * Compte le nombre d'entrées d'une table
     * @param $condition
     * @param null $table
     * @return mixed
     */
    public function count($condition = null, $table = null)
    {
        $sql = 'SELECT COUNT(id) as count FROM ';
        $sql .= $table ? $table : $this->table;

        if ($condition) {
            $sql .= ' WHERE ' . $condition;
        }
        $pdost = $this->db->query($sql);
        return $pdost->fetch()->count;
    }

    /**
     * Met à jour les données
     * @param  int $id l'id de l'entrée que l'on veut update
     * @param  $data les données
     * @param  string $table le nom de la table si besoin
     * @return bool
     */
    public function update($id, $data, $table = null)
    {
       $values = $tmp = [];

        foreach ($data as $d => $v) {
            $values[':' . $d] = $v;
            $tmp[] = $d . "=:" . $d;
        }

        $tmp = implode(',', $tmp);

        if ($table == null) {
            $table = $this->table;
        }

        $sql = 'UPDATE ' . $table . ' SET ' . $tmp . ' WHERE id = ' . $id;
        $pdost = $this->db->prepare($sql);
        $pdost->execute($values);
    }
} 