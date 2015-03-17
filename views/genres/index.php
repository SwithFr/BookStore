<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php');
use Helpers\Html;

?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Les livres par genres</h2>
    </div>

    <?php foreach ($data['letters'] as $k => $v): ?>
        <div class="genre">
            <h2 class="section__block__title"><?= $k; ?></h2>
            <?php foreach ($v as $w): ?>
                <p>
                    <a class="results__link" href="<?= Html::url('view', 'genre', ['id' => $w->id]); ?>"><?= $w->title; ?></a>
                </p>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

</div>