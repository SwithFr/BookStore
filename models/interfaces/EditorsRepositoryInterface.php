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
     */
    public function create($name, $website = '', $img = '', $history = '', $user_id);

    /**
     * Permet de récupérer les initiales des noms des éditeurs
     * @return array
     */
    public function getLetters();

    /**
     * Pagine les éditeurs pour la page "admin"
     * @param $nbpages
     * @param $nbperpage
     * @param $user_id
     * @return array
     */
    public function paginate($nbpages, $nbperpage, $user_id);


    /**
     * Récupère le nombre de livres d'un éditeur
     * @param $author_id
     * @return mixed
     */
    public function getBookCount($author_id);
} 