<?php use Helpers\Html; ?>
<?php if($data['book']): ?>
    <div id="content" class="content">
        <div class="section">
            <div class="section__header">
                <h2 class="section__title"><?= $data['book']->title; ?></h2>
                <div class="section__block bio">
                    <p class="section__block__year">
                        Écrit par <a href="<?= Html::url('view','author',['id'=>$data['book']->a_id]); ?>"
                                     class="author__name"><?= $data['book']->first_name . ' ' . $data['book']->last_name; ?></a> et editer par <?= $data['book']->e_name; ?>
                    </p>
                    <p class="section__block__category"><?= $data['book']->g_name; ?></p>
                    <div class="section__block__content">
                        <?= $data['book']->summary; ?>
                    </div>
                </div>
                <div class="section__block infos">
                    <img src="<?= $data['book']->img; ?>" class="section__block__img">
                    <p>Numéro ISBN : <?= $data['book']->isbn; ?></p>
                    <p>Nombre de pages : <?= $data['book']->nbpages; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>