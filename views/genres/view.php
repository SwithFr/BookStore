<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php');
?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Genre <?= $data['genre']->name; ?></h2>
    </div>
    <?php if (empty($data['genre']->books)): ?>
        <h2 class="noResult">Aucun livre dans cette catégorie pour le moment !</h2>
    <?php endif; ?>
    <?php foreach ($data['genre']->books as $book): ?>
        <div class="book section__block">
            <a href="<?= $book->link(); ?>">
                <?= $book->img('book__img'); ?>
            </a>

            <h3 class="section__block__title"><a
                    href="<?= $book->link() ?>"><?= $book->title; ?></a></h3>

            <p class="section__block__content">
                <?= $book->sumUp(250) ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>