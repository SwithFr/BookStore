<?php use Helpers\Html; use Components\Session; ?>
<?php $v = new \Behaviors\Votable(); ?>
<?php if($data['book']): ?>
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
                <p><span class="info__name">Numéro ISBN : </span><?= $data['book']->isbn; ?></p>
                <p><span class="info__name">Nombre de pages : </span><?= $data['book']->nbpages; ?></p>
                <div class="votes">
                    <?php if(Session::isLogged()): ?>
                        <div class="<?= $v->getClass('books', $data['book']->id); ?>">
                            <a class="voteUp" href="<?= Html::url('voteUp', 'book', ['ref_id' => $data['book']->id]); ?>">J'aime ce livre</a> /
                            <a class="voteDown" href="<?= Html::url('voteDown', 'book', ['ref_id' => $data['book']->id]); ?>">Je n'aime pas ce livre</a>
                        </div>
                    <?php else: ?>
                        <p class="section__block__infos">Connectez-vous ou créez un compte pour voter pour ce livre.</p>
                    <?php endif; ?>
                    <p>Note globale de <span class="nb"><?= $data['book']->vote; ?></span> sur 5</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>