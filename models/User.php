<?php


class User extends AppModel
{
    public $rules = [
        'login' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le champ login est obligatoire'],
            ['ruleName' => 'isString', 'message' => 'Doit être une chaine de caractère'],
        ],
        'password' => [
            ['ruleName' => 'notEmpty', 'message' => 'Le champ mot de passe est obligatoire']
        ],
        'email' => [
            ['ruleName' => 'isMail', 'message' => 'Doit être un email valide'],
            ['ruleName' => 'notEmpty', 'message' => 'Le champ email est obligatoire']
        ]
    ];

    /**
     * Permet de récuperer les infos en bdd pour vérifier si l'utilisateur à bien entré un bon login/mdp
     * @param  string $login Le login entré par l'utilisateur
     * @return stdClass      un objet content les indos trouvées.
     */
    public function getLogged($login)
    {
        $sql = 'SELECT id,password,role FROM users WHERE login=:login';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':login' => $login]);

        return $pdost->fetch();
    }

    /**
     * Ajoute un utilisateur en base de données
     * @param $login
     * @param $password
     * @param $email
     */
    public function create($login,$password,$email)
    {
        $sql = 'INSERT INTO users(login,password,email) VALUES (:login,:password,:email)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':login'=>$login,':password'=>$password,':email'=>$email]);
    }

    /**
     * Vérifie qu'on est pas déjà enregistré
     * @param $login
     * @param $email
     * @return mixed
     */
    public function alreadyExist($login,$email)
    {
        $sql = 'SELECT count(id) FROM users WHERE login=:login OR email=:email';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':login'=>$login,':email'=>$email]);
        return $pdost->fetch();
    }
} 