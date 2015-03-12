<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); use Helpers\Text; use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Les livres par genres</h2>
    </div>

    <?php foreach($data['letters'] as $k => $v): ?>
        <h1><?= $k; ?></h1>
        <?php foreach($v as $w): ?>
            <p><?= $w; ?></p>
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>