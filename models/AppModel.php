<?php


class AppModel 
{
    /**
     * La connexion PDO
     * @var null|PDO
     */
    protected  $db = null;

    /**
     * Le nom de la table
     * @var null|string
     */
    protected $table = null;

    function __construct()
    {
        if (is_null($this->db))
           $this->db = DbProvider::getDb();
        
        $this->table = strtolower(get_class($this)) . 's';
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
     * Permet de récupérer les X entités les plus populaires
     * @param string $fields
     * @param int $limit
     * @return array
     */
    public function getPopular($fields, $limit)
    {
        $sql = 'SELECT ' . $fields . '
                FROM ' . $this->table . '
                JOIN votes ON ref_id = ' . $this->table . '.id
                WHERE ref = \'' . $this->table . '\'
                ORDER BY value DESC
                LIMIT ' . $limit;
        $pdost = $this->db->query($sql);

        if ($limit > 1)
            return $pdost->fetchAll();

        return $pdost->fetch();
    }

} 