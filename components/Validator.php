<?php

namespace Components;

class Validator
{

    // Tableau des erreurs à retourner avec le message ['champ'=>'message']
    private $errors = [];

    /**
     * Fonction principale du validateur. Renvoie vers les fonctions correpondantes aux règles de validation demandées
     * @param  array $data Les donnée à valider
     * @param  array $rules Le tableaux des règles de validation
     * @return bool   true ou false selon si tous les champs sont valides ou non
     */
    public function validate($data, array $rules)
    {

        foreach ($data as $field => $value) {

            // Pour chaque données on vérifie si il existe une règle
            if (isset($rules[$field])) {

                // Si on a une règle on va appeller la/les fonctions pour tester si les données sont valides
                foreach ($rules[$field] as $k => $v) {

                    //$v['ruleName'] correspond au nom d'une fonction de validation
                    $this->$v['ruleName']($field, $value, isset($v['message']) ? $v['message'] : null);

                }

            }
        }

        // On regarde la taille du tableau, si elle est différente de 0 c'est qu'on a des erreurs
        if (count($this->errors) == 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Vérifie si les données ne sont pas vides
     * @param $field
     * @param $value
     * @param null $message
     * @return bool
     */
    public function notEmpty($field, $value, $message = null)
    {

        // Si la valeur (sans espace) n'est pas vide
        if (trim($value) != "") {

            // On incrémente le nombre de champs valide
            return true;

        } else {

            // Sinon on regarde si on a un message prévu ou pas
            if ($message == null)
                $message = "le champ $field est obligatoire";

            // On ajoute le champ et son message dans le tableau d'erreur.
            $this->errors[$field] = $message;

            return false;

        }

    }

    /**
     * Vérifie si les données sont une chaine de caractères
     * @param $field
     * @param $value
     * @param null $message
     * @return bool
     */
    public function isString($field, $value, $message = null)
    {

        if (is_string(trim($value))) {

            return true;

        } else {

            if ($message == null)
                $message = "le champ $field est obligatoire";

            $this->errors[$field] = $message;
            return false;
        }

    }

    /**
     * Vérifie si c'est un email au bon format
     * @param $field
     * @param $value
     * @param null $message
     * @return bool
     */
    public function isMail($field, $value, $message = null)
    {

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {

            return true;

        } else {

            if ($message == null)
                $message = "le champ $field n'est pas un email valide";

            $this->errors[$field] = $message;

            return false;

        }

    }

    /**
     * Vérifie si c'est un nombre
     * @param $field
     * @param $value
     * @param null $message
     * @return bool
     */
    public function isInt($field, $value, $message = null)
    {

        if (is_numeric($value)) {

            return true;

        } else {

            if ($message == null)
                $message = "le champ $field n'est pas un nombre";

            $this->errors[$field] = $message;
            return false;

        }

    }

    /**
     * Vérifie si $value est une date valide
     * @param $field
     * @param $value
     * @param null $message
     * @return bool
     */
    public function isDate($field, $value, $message = null)
    {
        if ($message == null)
            $message = "le champ $field n'est pas une date valide (AAAA-MM-JJ";

        if (empty($value))
            return true;

        if ((preg_match('/-/',$value) == 0)) {
            $this->errors[$field] = $message;
            return false;
        }

        $date = explode('-',$value);

        if (!isset($date[0]) || !isset($date[1]) || !isset($date[2]) || !is_numeric($date[0]) || !is_numeric($date[1]) || !is_numeric($date[2])) {
            $this->errors[$field] = $message;
            return false;
        }

        if (checkdate($date[1],$date[2],$date[0]) || empty(trim($value))) {

            return true;

        } else {

            $this->errors[$field] = $message;
            return false;

        }
    }

    /**
     * Retourne le message d'erreur du champ passé en paramettre
     * @param $field
     * @return null
     */
    public function message($field)
    {
        if (isset($this->errors[$field]))
            return $this->errors[$field];
        else
            return null;
    }

    /**
     * Retourne le tableau contenant toutes les erreurs
     * @return array|null
     */
    public function errors()
    {
        if (!empty($this->errors))
            return $this->errors;
        else
            return null;
    }

}