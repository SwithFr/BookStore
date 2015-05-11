<?php


namespace Models\Entities;


use Helpers\Html;

class CommentEntity
{
    public function deleteLink(){
        return '<a href="' . Html::url('delete','comment',['ref'=>$this->ref,'ref_id'=>$this->ref_id]) . '" class="com--delete">Supprimer</a>';
    }

    public function editLink(){
        return '<a href="' . Html::url('edit','comment',['ref'=>$this->ref,'ref_id'=>$this->ref_id]) . '" class="com--edit">Editer</a>';
    }
} 