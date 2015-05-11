<?php


namespace Models\Entities;


class AppEntity
{

    /**
     * Affiche le score d'une entité
     * @return string
     */
    public function score()
    {
        $class = ($this->vote > 40) ? 'nb-p' : 'nb-n';
        return "<span class='nb $class'>" . $this->vote . "</span> % de satisfaction.";
    }
} 