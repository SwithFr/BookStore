<?php


class AppModel 
{
    protected  $db = null;
    protected $table = null;

    function __construct()
    {
        if (!is_null($this->db)) {
           $this->db = DbProvider::getDb();
        }
        var_dump($this->db);die();
    }
} 