<?php


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
            echo "<a href='#' class='alert alert-" . $_SESSION['flash']['type'] . "'>" . $_SESSION['flash']['message'] . "</a>";
            unset($_SESSION['flash']);
        }
    }
} 