<?php


namespace Models\Interfaces;


interface EditorsRepositoryInterface
{
    /**
     * Ajoute un éditeur
     * @param $name
     * @param string $website
     * @param string $img
     * @param string $history
     * @param $user_id
     * @return
     */
    public function create($name, $website = '', $img = '', $history = '', $user_id);
} 