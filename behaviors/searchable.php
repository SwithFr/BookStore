<?php


namespace Behaviors;


trait searchable
{

    /**
     * Permet d'effectuer une chercher
     * @param  string $what ce que l'on doit chercher
     * @param  array $where sur quel champs
     * @param string $get ce que l'on veut récupérer
     * @param null $table
     * @param  string $how Comment doit on chercher [around|exactly]
     * @return mixed
     */
    public function search($what, Array $where, $get = '*', $table = null, $how = "around")
    {

        if (is_null($table))
            $table = $this->table;

        $query = "SELECT DISTINCT $get FROM $table WHERE ";
        $params = [];
        if ($how === "around") {
            $what = explode(" ", $what);
        } else {
            $what = [$what];
        }

        foreach ($where as $c) {
            foreach ($what as $w) {
                if ($how === "around") {
                    $params[] = $c . " LIKE " . "'%$w%'";
                } elseif ($how === "exactly") {
                    $params[] = $c . " LIKE " . "'% $w %'";
                }
            }
        }

        $params = implode(" OR ", $params);

        $req = $this->db->query($query . $params);

        return $req->fetchAll();
    }

    /**
     * Effectue une recherche sur plusieurs tables
     * @param array $research
     * @return mixed
     */
    public function searchAll(Array $research)
    {
        foreach ($research as $table => $infos) {
            $results[$table] = $this->search($infos['what'], $infos['where'], $infos['get'], $table);
        }

        return $results;
    }

} 