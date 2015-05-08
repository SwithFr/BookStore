<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Les livres par genres</h2>
    </div>

    <?php foreach($data['books'] as $book): ?>
        <h2><?= $book->title; ?></h2>
        <p><?= $book->vote; ?></p>

    <?php endforeach; ?>

</div>