<?php


class Librarie extends AppModel
{
    protected $table = 'libraries';

    public function create($name, $adress, $tel, $email, $user_id)
    {
        $sql = 'INSERT INTO libraries(name,address,tel,email,user_id) VALUES (:name,:address,:tel,:email,:user_id)';
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':name' => $name, ':address' => $adress, ':tel' => $tel, ':email' => $email, ':user_id' => $user_id]);
    }

} 