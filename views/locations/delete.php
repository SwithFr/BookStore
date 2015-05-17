<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Confirmer la suppresion de l'emplacement <?= $data['location']->name; ?> ?</h2>

    <a href="<?= Html::url('goDelete', 'location', ['id' => $data['location']->id]); ?>"
       class="btn btn--inline btn--delete">Confirmer</a>
    <a href="<?= Html::url('edit', 'librarie', ['library' => $_GET['library']]); ?>" class="btn btn--inline btn--send">Annuler</a>
</div>