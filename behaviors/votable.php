<?php


namespace Behaviors;


use Models\AppModel;

class Votable extends AppModel
{

    /**
     * Point d'entrée pour un vote
     * @param $ref
     * @param $ref_id
     * @param $user_id
     * @param $value
     * @return bool
     */
    public function vote($ref, $ref_id, $user_id, $value)
    {
        // regarde si l'utilisateur a déjà voté
        $vote = $this->hasVoted($user_id, $ref, $ref_id);
        if ($vote) {
            if ($vote->value != $value) {
                $this->updateVote($ref, $ref_id, $user_id, $value);
            }
        } else {
            $this->doVote($ref, $ref_id, $user_id, $value);
        }

        $this->updateCount($ref, $ref_id);
        return true;
    }

    /**
     * Vérifie si l'utilisateur à déjà voté pour ce ref/ref_id
     * @param $user_id
     * @param $ref
     * @param $ref_id
     * @return mixed
     */
    public function hasVoted($user_id, $ref, $ref_id)
    {
        $sql = "SELECT * FROM votes WHERE ref = '$ref' AND ref_id=:ref_id AND user_id = $user_id";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':ref_id' => $ref_id]);
        return $pdost->fetch();
    }

    /**
     * Met à jour la note moyenne du ref/ref_id
     * @param $ref
     * @param $ref_id
     */
    private function updateCount($ref, $ref_id)
    {
        $score = $this->getScore($ref, $ref_id);
        $sql = "UPDATE $ref SET vote = $score WHERE id = :ref_id";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':ref_id' => $ref_id]);
    }

    /**
     * Met à jour un vote
     * @param $ref
     * @param $ref_id
     * @param $user_id
     * @param $value
     */
    private function updateVote($ref, $ref_id, $user_id, $value)
    {
        $sql = "UPDATE votes SET value = $value WHERE ref_id = :ref_id AND ref = '$ref' AND user_id = $user_id";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':ref_id' => $ref_id]);
    }

    /**
     * Enregistre un nouveau vote
     * @param $ref
     * @param $ref_id
     * @param $user_id
     * @param $value
     */
    private function doVote($ref, $ref_id, $user_id, $value)
    {
        $sql = "INSERT INTO votes (ref, ref_id, value, user_id) VALUES ('$ref', :ref_id, $value, $user_id)";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':ref_id' => $ref_id]);
    }

    /**
     * Calcul le socre d'un ref
     * @param $ref
     * @param $ref_id
     * @return float
     */
    private function getScore($ref, $ref_id)
    {
        $sql = "SELECT COUNT(id) as count, value FROM votes WHERE ref = '$ref' AND ref_id = :ref_id GROUP BY value";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':ref_id' => $ref_id]);
        $results = $pdost->fetchAll();
        $negatifs = $positifs = 0;
        foreach ($results as $result) {
            if ($result->value == -1) {
                $negatifs = $result->count;
            } else {
                $positifs = $result->count;
            }
        }
        return round( (($positifs - $negatifs < 0) ? 0 : $positifs - $negatifs) / ($positifs + $negatifs), 4) * 100;
    }

    /**
     * Récupère la class en fonction du vote de l'utilisateur
     * @param $ref
     * @param $ref_id
     * @return string
     */
    public function getClass($ref, $ref_id)
    {
        $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : $_SESSION['user_id'];
        $vote = $this->hasVoted($user_id, $ref, $ref_id);
        if ($vote) {
            return $vote->value == 1 ? 'liked' : 'disliked';
        }
    }


} 