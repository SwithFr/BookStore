<?php


namespace Models\Interfaces;


interface UsersRepositoryInterface
{
    /**
     * Permet de récuperer les infos en bdd pour vérifier si l'utilisateur à bien entré un bon login/mdp
     * @param  string $login Le login entré par l'utilisateur
     * @return stdClass      un objet content les indos trouvées.
     */
    public function getLogged($login);

    /**
     * Ajoute un utilisateur en base de données
     * @param $login
     * @param $password
     * @param $email
     */
    public function create($login, $password, $email);

    /**
     * Vérifie qu'on est pas déjà enregistré
     * @param $login
     * @param $email
     * @return mixed
     */
    public function alreadyExist($login, $email);
} 