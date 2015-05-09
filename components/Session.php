<?php

namespace Components;

class Session
{
    /**
     * Permet de définir un message flash
     * @param string $message le message à afficher
     * @param string $type le type de message [success]
     */
    public static function setFlash($message, $type = "success")
    {
        $_SESSION['flash']['message'] = $message;
        $_SESSION['flash']['type'] = $type;
    }

    /**
     * Permet d'afficher un message flash si il est défini
     * @return string
     */
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo "<a href='#' id='alert' class='alert alert--" . $_SESSION['flash']['type'] . "'>" . $_SESSION['flash']['message'] . "</a>";
            unset($_SESSION['flash']);
        }
    }

    /**
     * Permet de savoir si un utilisateur est connecté
     * @return bool
     */
    public static function isLogged()
    {
        return (isset($_SESSION['user_id']) || isset($_COOKIE['user_id']));
    }

    public static function getId()
    {
        return $_SESSION['user_id'] || $_COOKIE['user_id'];
    }
} 