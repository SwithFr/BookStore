<?php


class Location extends AppModel
{
    public function getAllFromUserLibrary($user_id)
    {
        $sql = 'SELECT locations.id, locations.name
                FROM locations
                JOIN location_library ON location_id = locations.id
                JOIN libraries ON library_id = libraries.id
                WHERE libraries.user_id = :user_id';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':user_id' => $user_id]);

        return $pdost->fetchAll();
    }
} 