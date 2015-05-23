<?php use Helpers\Html; ?>
<?php ?>
<div class="section">
    <div class="section__block">
        <?= $data['editor']->img; ?>

        <h3 class="section__block__title"><a
                href="<?= Html::url('view', 'editor', ['id'=>$data['editor']->id]); ?>"><?= $data['editor']->name; ?></a></h3>

        <p class="section__block__content">
           <?= \Helpers\Text::cut($data['editor']->history, 250); ?>
        </p>
    </div>
</div>
<a class="btn btn--delete btn--inline" href="<?= Html::url('goDelete', 'editor', ['id' => $data['editor']->id]); ?>">Confirmer
    la suppression</a>
<a class="btn btn--add btn--inline" href="<?= Html::url('manage', 'editor'); ?>">Annuler</a>
