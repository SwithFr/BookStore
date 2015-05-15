<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); use Helpers\Html; ?>
<div class="section">
    <div class="section__block">
        <div class="section__header">
            <h2 class="section__block__title">Classement des 10 meilleurs livres</h2>
        </div>
        <?php foreach($data['books'] as $book): ?>
            <h2><?= $book->title; ?></h2>
            <p><?= $book->score(); ?></p>
        <?php endforeach; ?>
    </div>
    <div class="section__block populars__authors">
        <div class="section__header">
            <h2 class="section__block__title">Classement des 10 meilleurs Auteurs</h2>
        </div>
        <?php foreach($data['authors'] as $author): ?>
            <h2><?= $author->name(); ?></h2>
            <p><?= $author->score(); ?></p>
        <?php endforeach; ?>
    </div>
</div>