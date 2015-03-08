<?php

class UsersController extends AppController
{
    /**
     * FORMUALIRE DE CONNEXION
     */
    public function check()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST" && !isset($_COOKIE['user_id'])) {
            $v = new Validator();
            if (!$v->validate($_POST, $this->User->rules))
                die('Pas bon :p');
            $user = $this->User->getLogged($_POST['login']);
            if ($user->password != $_POST['password']) {
                die('Identifiants inconnus');
            } else {
                $this->connect($user,$_POST['remember']);
            }
        }
    }

    /**
     * Stoke les infos en session et cookies
     * @param $user
     * @param $remember
     */
    private function connect($user,$remember)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_role'] = $user->role;
        if ($remember) {
            setcookie("user_id", $user->id, time() + 7 * 24 * 3600);
            setcookie("user_role", $user->role, time() + 7 * 24 * 3600);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function disconnect()
    {
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        setcookie("user_id", "", time() - 7 * 24 * 3600);
        setcookie("user_role", "", time() - 7 * 24 * 3600);
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
} 