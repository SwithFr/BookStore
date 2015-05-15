<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); use Helpers\Html; ?>
<div class="section">
    <div class="section__block">
        <div class="section__header">
            <h2 class="popular__title">Classement des 10 meilleurs livres</h2>
        </div>
        <?php foreach($data['books'] as $book): ?>
            <div class="popular">
                <h2><a href="<?= $book->link(); ?>"><?= $book->title; ?></a></h2>
                <p class="score"><?= $book->score(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="section__block populars__authors">
        <div class="section__header">
            <h2 class="popular__title">Classement des 10 meilleurs Auteurs</h2>
        </div>
        <?php foreach($data['authors'] as $author): ?>
            <div class="popular">
                <h2><a href="<?= $author->link(); ?>"><?= $author->name(); ?></a></h2>
                <p class="score"><?= $author->score(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>