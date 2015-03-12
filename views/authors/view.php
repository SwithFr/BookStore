<?php use Helpers\Html; ?>
<?php if($data['author']): ?>
    <div id="content" class="content">
        <div class="section">
            <div class="section__header">
                <h2 class="section__title"><?= $data['author']->first_name . ' ' . $data['author']->last_name; ?></h2>
                <div class="section__block bio">
                    <p class="section__block__year">
                        <?= $data['author']->date_birth . ' - ' . $data['author']->date_death; ?>
                    <div class="section__block__content">
                        <?= $data['author']->bio; ?>
                    </div>
                </div>
                <div class="section__block infos"><img src="<?= $data['author']->img; ?>" class="section__block__img"></div>
            </div>
        </div>
    </div>
<?php endif; ?>