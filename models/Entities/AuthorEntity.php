<?php


namespace Models\Entities;


use Helpers\Html;
use Helpers\Text;

class AuthorEntity
{
    /**
     * Affiche le nom et prénom
     * @return string
     */
    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Génère le lien vers la vue de l'auteur
     * @return string
     */
    public function link()
    {
        return Html::url('view','author',['id'=>$this->id]);
    }

    /**
     * Affiche les date de 'lauteur
     * @return string
     */
    public function date()
    {
        $date = $this->date_birth;
        if ($this->date_death !== '') {
           $date .= ' - ' . $this->date_death;
        }
        return $date ;
    }

    /**
     * Affiche l'extrait du résumé de l'auteur
     * @param int $limit
     * @return string
     */
    public function sumUp($limit = 500)
    {
        return Text::cut($this->bio, $limit);
    }
}