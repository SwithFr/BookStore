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
            if (!$v->validate($_POST, $this->User->rules)) {
                Session::setFlash("Verifiez vos informations !", 'error');
                return compact($v->errors());
            }
            $user = $this->User->getLogged($_POST['login']);
            if ($user->password != $_POST['password']) {
                Session::setFlash("Identifiants inconnus !", 'error');
            } else {
                $this->connect($user, $_POST['remember']);
            }
        }
    }

    /**
     * Stoke les infos en session et cookies
     * @param $user
     * @param $remember
     */
    private function connect($user, $remember)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_role'] = $user->role;
        if ($remember) {
            setcookie("user_id", $user->id, time() + 7 * 24 * 3600);
            setcookie("user_role", $user->role, time() + 7 * 24 * 3600);
        }
        Session::setFlash('Vous êtes maintenant connecté.');
        header("Location: " . Html::url('index','book'));
        exit();
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
        Session::setFlash("Vous êtes bien déconnecté !");
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    /**
     * Formulaire d'enregistrement
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST" && !isset($_COOKIE['user_id'])) {
            $v = new Validator();
            if (!$v->validate($_POST, $this->User->rules)) {
                Session::setFlash("Verifiez vos informations !", 'error');
                $errors = $v->errors();
                return compact("errors");
            }
            if ($this->User->alreadyExist($_POST['login'], $_POST['email'])) {
                Session::setFlash("Ce login ou email est déjà utilisé !", 'error');
                return false;
            }
            $this->User->create($_POST['login'], $_POST['password'], $_POST['email']);
            Session::setFlash("Votre compte a bien été créé !");
            header('Location: ' . Html::url('check', 'user'));
            exit();
        }
    }
} 