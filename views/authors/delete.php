<?php use Helpers\Html; ?>
<?php use Helpers\Text; ?>
<div class="section">
    <div class="section__block">
        <?= $data['author']->img(); ?>

        <h3 class="section__block__title"><a
                href="<?= $data['author']->link(); ?>"><?= $data['author']->name(); ?></a></h3>

        <p class="section__block__content">
            <?= $data['author']->sumUp(250); ?>
        </p>
    </div>
</div>
<a class="btn btn--delete btn--inline" href="<?= Html::url('goDelete','author',['id'=>$data['author']->id]); ?>">Confirmer la suppression</a>
<a class="btn btn--add btn--inline" href="<?= Html::url('index','user'); ?>">Annuler</a>
