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
     * @return mixed|void
     */
    public function create($name, $library_id);

    /**
     * Supprimer la realtion location/library
     * @param $location_id
     */
    public function deleteLocationAssoc($location_id);
}