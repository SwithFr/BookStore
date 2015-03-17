<?php


namespace Models\Interfaces;


interface LocationsRepositoryInterface
{
    /**
     * Récupère les les emplacements d'une bibliothèque
     * @param $user_id
     * @return array
     */
    public function getAllFromUserLibrary($user_id);

    /**
     * @param $name
     * @param $library_id
     * @return mixed
     */
    public function create($name, $library_id);

    /**
     * @param $library_id
     * @param $location_id
     * @return mixed
     */
    private function newLocationLibrary($library_id, $location_id);
}