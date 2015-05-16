<?php use Helpers\Html; ?>
<div class="section section--dashbord">
    <div class="section__header">
        <h2 class="section__title">
            Bienvenue sur votre Dashboard
            <span class="user__login"><a href="<?= Html::url('edit', 'user'); ?>"
                                         title="Editez vos informations"><?= $data['user']->login; ?></a></span>
        </h2>
    </div>
    <?php if (!$data['hasLibrary']): ?>
        <a class="btn alert alert--warning" href="<?= Html::url('add', 'librarie'); ?>">Veuillez d'abord créer une
            bibliothèque pour pouvoir ajouter des livres.</a>
    <?php else: ?>
        <a class="btn btn--add" href="<?= Html::url('manage', 'librarie'); ?>">Gérer votre bibliothèque</a>
    <?php endif; ?>
    <?php if (!$data['hasAuthor']): ?>
        <a class="btn alert alert--warning clearfix" href="<?= Html::url('add', 'author'); ?>">Vous n'avez pas encore
            ajouté d'auteur, ajoutez en un !</a>
    <?php else: ?>
        <a class="btn btn--add" href="<?= Html::url('manage', 'author'); ?>">Gérer vos auteurs</a>
    <?php endif; ?>
    <?php if (!$data['hasEditor']): ?>
        <a class="btn alert alert--warning clearfix" href="<?= Html::url('add', 'editor'); ?>">Vous n'avez pas encore
            ajouté d'éditeur, ajoutez en un !</a>
    <?php else: ?>
        <a class="btn btn--add" href="<?= Html::url('manage', 'editor'); ?>">Gérer vos éditeurs</a>
    <?php endif; ?>
</div>
