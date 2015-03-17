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
     */
    public function create($name, $website = '', $img = '', $history = '');
} 