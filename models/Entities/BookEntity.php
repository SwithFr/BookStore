<?php


namespace Models\Entities;


use Helpers\Html;
use Helpers\Text;

class BookEntity
{
    /**
     * Affiche le nom de l'auteur bien formaté
     * @return string
     */
    public function getAuthorName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Génère le lien vers la vue du livre
     * @return string
     */
    public function link()
    {
        return Html::url('view', 'book', ['id' => $this->id]);
    }

    /**
     * Affiche l'image du livre
     * @return string
     */
    public function img()
    {
        return '<img src="' . $this->img . '" class="section__block__img">';
    }

    /**
     * Affiche les résumé du livre
     * @param int $limit
     * @return string
     */
    public function sumUp($limit = 500)
    {
        return Text::cut($this->summary, $limit);
    }

} 