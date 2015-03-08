<?php

class UsersController extends AppController
{
    public function check()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $v = new Validator();
            if (!$v->validate($_POST, $this->User->rules))
                die('Pas bon :p');
            $user = $this->User->getLogged($_POST['login']);
            if ($user->password != $_POST['password']) {
                die('Identifiants inconnus');
            } else {
                $this->connect($user);
            }
        }
    }

    private function connect(User $user)
    {
        $_SESSION['id'] = $user->id;
        $_SESSION['role'] = $user->role;
        setcookie("user_id", $user->id, time() + 7 * 24 * 3600);
//        header("Location: " . $_SERVER['PHP_SELF']);
    }

    public function disconnect()
    {
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        setcookie("user_id", "", time() - 7 * 24 * 3600);
//        header('Location: ' . $_SERVER['PHP_SELF']);
    }
} 