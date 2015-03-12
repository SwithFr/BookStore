<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); use Helpers\Html; use Helpers\Text; ?>
<div class="section vedettes">
    <div class="section__header">
        <h2 class="section__title title--inline">Livres les mieux notés :</h2>
        <a href="./views/books/byAuthor.html" class="section__readMore">Voir tout le classement</a>
    </div>
    <?php foreach($data['books'] as $book): ?>
        <div class="section__block">
            <img src="<?= $book->img; ?>" class="section__block__img">
            <h3 class="section__block__title"><a href="<?= Html::url('view','book',['id'=>$book->id]); ?>"><?= $book->title; ?></a></h3>
            <p class="section__block__author"><?= $book->first_name . ' ' . $book->last_name; ?></p>
            <p class="section__block__content">
                <?= Text::cut($book->summary,500); ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>
<div class="section author">
    <div class="section__header">
        <h2 class="section__title title--inline">Auteur le mieux noté</h2>
        <a href="./views/books/byAuthor.html" class="section__readMore">Voir plus du même auteur</a>
    </div>
    <div class="section__block">
        <h3 class="section__block__title"><a href="<?= Html::url('view','author',['id'=>$data['author']->id]); ?>"><?= $data['author']->first_name . ' ' . $data['author']->last_name; ?></a></h3>
        <p class="section__block__year"><?= $data['author']->date_birth; ?> - <?= $data['author']->date_death; ?></p>
        <p class="section__block__content">
            <?= Text::cut($data['author']->bio,500); ?>
        </p>
        <div class="author__count">
            <p class="nb author__nbBooks">12</p>
            <p class="nb author__eval">4.5</p>
        </div>
    </div>
    <div class="section__block">
        <img src="<?= $data['author']->img; ?>" class="section__block__img">
    </div>
</div>