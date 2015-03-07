<?php


class Text 
{
    /**
     * Permet de tronquer un texte
     * @param $text
     * @param $limit
     * @return string
     */
    public function cut($text, $limit)
    {
        return substr($text, 0, $limit) . "...";
    }
} 