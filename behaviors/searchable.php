<?php


namespace Behaviors;


trait searchable
{

    /**
     * Permet d'effectuer une chercher
     * @param  string $what ce que l'on doit chercher
     * @param  array $where sur quel champs
     * @param string $get ce que l'on veut récupérer
     * @param  string $how Comment doit on chercher [around|exactly]
     * @return
     */
    public function search($what, Array $where, $get = '*', $how = "around")
    {

        $query = "SELECT DISTINCT $get FROM {$this->table} WHERE ";
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
        var_dump($req->fetchAll());
        die();
        return $req->fetchAll();
    }

} 