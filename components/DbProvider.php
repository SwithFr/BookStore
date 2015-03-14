<?php

namespace Components;

use PDO;
use PDOException;

class DbProvider
{

    /**
     * Les paramettres de la connexion à la base de données
     * @var array|mixed
     */
    private $settings = [];

    /**
     * La connexion PDO
     * @var null|PDO
     */
    private $db = null;

    /**
     * L'instance du singleton
     * @var null|DbProvider
     */
    private static $_instance = null;

    private function __construct()
    {
        # On récupère le tableau d'options de database.php
        $this->settings = require(D_CONFIGS . DS . 'database.php');

        try {
            $this->db = new PDO(
                'mysql:dbname=' . $this->settings['dbName'] . ';host:' . $this->settings['host'],
                $this->settings['username'],
                $this->settings['password'],
                $this->settings['options']
            );
            $this->db->query('SET CHARACTER SET UTF8');
            $this->db->query('SET NAMES UTF8');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de récupérer la connexion PDO
     * @return null|PDO
     */
    public static function getDb()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DbProvider();
        }
        return self::$_instance->db;
    }

} 