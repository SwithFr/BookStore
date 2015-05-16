<?php


namespace Models\Entities;


use Helpers\Html;

class CommentEntity
{
    public function deleteLink()
    {
        return '<a href="' . Html::url('delete', 'comment', ['ref' => $this->ref, 'ref_id' => $this->ref_id, 'comment_id' => $this->id]) . '" class="com--delete">Supprimer</a>';
    }
}