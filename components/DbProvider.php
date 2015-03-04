<?php


class DbProvider 
{

    private $settings = [];
    private $db = null;
    private static $_instance = null;

    private function __construct()
    {
        $this->settings = require(D_CONFIGS . DS . 'database.php');
        try {
            $this->db = new PDO(
                'mysql:dbname='. $this->settings['dbName'] . ';host:' . $this->settings['host'],
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

    public static function getDb()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DbProvider();
        }
        return self::$_instance->db;
    }

} 