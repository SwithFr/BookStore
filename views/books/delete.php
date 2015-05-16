<?php use Helpers\Html;
use Helpers\Text; ?>
<?php ?>
<div class="section">
    <div class="section__block">
        <img src="<?= $data['book']->img; ?>" class="section__block__img">

        <h3 class="section__block__title"><a
                href="<?= Html::url('view', 'book', ['id' => $data['book']->id]); ?>"><?= $data['book']->title; ?></a>
        </h3>

        <p class="section__block__author"><?= $data['book']->first_name . ' ' . $data['book']->last_name; ?></p>

        <p class="section__block__content">
            <?= Text::cut($data['book']->summary, 500); ?>
        </p>
    </div>
</div>
<a class="btn btn--delete btn--inline" href="<?= Html::url('goDelete', 'book', ['id' => $data['book']->id]); ?>">Confirmer
    la suppression</a>
<a class="btn btn--add btn--inline" href="<?= Html::url('index', 'user'); ?>">Annuler</a>
