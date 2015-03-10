<?php

namespace Helpers;

class Text
{
    /**
     * Permet de tronquer un texte
     * @param $text
     * @param $limit
     * @return string
     */
    public static function cut($text, $limit)
    {
        return substr($text, 0, $limit) . "...";
    }
} 