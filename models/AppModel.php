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
} 