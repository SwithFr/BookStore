<?php

namespace Controllers;

use Components\Request;
use Components\Session;
use Components\Validator;
use Models\Interfaces\UsersRepositoryInterface;

class UsersController extends AppController
{
    function __construct(UsersRepositoryInterface $user, Request $request)
    {
        parent::__construct($request);
        $this->User = $user;
    }

    /**
     * FORMUALIRE DE CONNEXION
     */
    public function check()
    {
        if (isset($_COOKIE['user_login']) && isset($_COOKIE['user_id'])) {
            $user = $this->User->getLogged($_COOKIE['user_login']);
            $cookie_token = sha1($_COOKIE['user_id'] . sha1('fakeStringJusteForSecureToken') . $_COOKIE['user_login']);
            $user_token = sha1($user->id . sha1('fakeStringJusteForSecureToken') . $user->login);
            if ($cookie_token == $user_token) {
                $this->connect($user, true);
            }
        }

        if ($this->request->isPost()) {
            $v = new Validator();
            if (!$v->validate($_POST, $this->User->rules)) {
                Session::setFlash("Verifiez vos informations !", 'error');
                $errors = $v->errors();
                return compact("errors");
            }
            $user = $this->User->getLogged($_POST['login']);
            if ($user->password != sha1($_POST['password'])) {
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
            setcookie("user_login", $user->login, time() + 7 * 24 * 3600);
        }
        Session::setFlash('Vous êtes maintenant connecté.');
        $this->redirect('index', 'book');
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function disconnect()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_login']);
        setcookie("user_id", "", time() - 7 * 24 * 3600);
        setcookie("user_role", "", time() - 7 * 24 * 3600);
        setcookie("user_login", "", time() - 7 * 24 * 3600);
        Session::setFlash("Vous êtes bien déconnecté !");
        $this->redirect('index', 'book');
    }

    /**
     * Formulaire d'enregistrement
     */
    public function register()
    {
        if ($this->request->isPost() && !isset($_COOKIE['user_id'])) {
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
            $this->User->create($_POST['login'], sha1($_POST['password']), $_POST['email']);
            Session::setFlash("Votre compte a bien été créé !");
            $this->redirect('check', 'user');
        }
    }

    /**
     * PAGE UTILISATEUR
     */
    public function index()
    {
        $this->loadModel('Author');
        $user_id = Session::getId();
        $user = $this->User->find(null, $user_id);
        if (!$user) {
            $this->redirect('sendError', 'error', ['type' =>'unauthorized']);
        }
        $hasLibrary = $this->User->count('user_id = ' . $user_id, 'libraries');
        $hasAuthor = $this->User->count('user_id = ' . $user_id, 'authors');
        $hasEditor = $this->User->count('user_id = ' . $user_id, 'editors');
        $hasBookToRead = $this->User->count('user_id = ' . $user_id, 'watch_later');

        return compact('user', 'hasLibrary', 'hasAuthor', 'hasEditor', 'hasBookToRead');
    }
} 