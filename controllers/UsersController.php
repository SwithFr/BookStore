<?php

class UsersController extends AppController
{
    /**
     * FORMUALIRE DE CONNEXION
     */
    public function check()
    {
        if (Session::isLogged())
            $this->redirect('index','book');

        if (isset($_COOKIE['user_login'])) {
            $user = $this->User->getLogged($_COOKIE['user_login']);
            $this->connect($user,true);
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $v = new Validator();
            if (!$v->validate($_POST, $this->User->rules)) {
                Session::setFlash("Verifiez vos informations !", 'error');
                $errors = $v->errors();
                return compact("errors");
            }
            $user = $this->User->getLogged($_POST['login']);
            if ($user->password != $_POST['password']) {
                Session::setFlash("Identifiants inconnus !", 'error');
            } else {
                $this->connect($user, isset($_POST['remember']));
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
        $_SESSION['user_login'] = $user->login;
        if ($remember) {
            setcookie("user_id", $user->id, time() + 7 * 24 * 3600);
            setcookie("user_role", $user->role, time() + 7 * 24 * 3600);
        }
        Session::setFlash('Vous êtes maintenant connecté.');
        $this->redirect('index','book');
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function disconnect()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        setcookie("user_id", "", time() - 7 * 24 * 3600);
        setcookie("user_role", "", time() - 7 * 24 * 3600);
        Session::setFlash("Vous êtes bien déconnecté !");
        $this->redirect('index','book');
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
            $this->redirect('check','user');
        }
    }

    /**
     * PAGE UTILISATEUR
     */
    public function account()
    {
        if (!Session::isLogged())
            $this->redirect('notLogged','error');

        $this->loadModel('Librarie');
        $this->loadModel('Book');
        $user_id = $_SESSION['user_id'];
        $user = $this->User->find($user_id);
        if (!$user) {
            header('Location: ' . Html::url('unauthorized', 'error'));
            exit();
        }
        if ($this->User->hasLibrary($user_id)) {
            $hasLibrary = true;
            $library = $this->Librarie->getFromUser($user_id);
            $books = $this->Book->getAllFromLibrary(
                'books.id, title, first_name, last_name',
                $library->id
            );
        } else {
            $hasLibrary = false;
            $library = null;
            $books = null;
        }
        return compact('user', 'hasLibrary', 'library','books');
    }
} 