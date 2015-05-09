<?php use Helpers\Html; ?>
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
                <p>Numéro ISBN : <?= $data['book']->isbn; ?></p>
                <p>Nombre de pages : <?= $data['book']->nbpages; ?></p>
            </div>
            <?php if( \Components\Session::isLogged() ): ?>
                <div class="<?= $v->getClass('books', $data['book']->id); ?>">
                    <a class="voteUp" href="<?= Html::url('voteUp', 'book', ['ref_id' => $data['book']->id]); ?>">J'aime ce livre</a> /
                    <a class="voteDown" href="<?= Html::url('voteDown', 'book', ['ref_id' => $data['book']->id]); ?>">Je n'aime pas ce livre</a>
                </div>
            <?php endif; ?>
            <p>Et il a une note globale de <span class="nb"><?= $data['book']->vote; ?></span> sur 5</p>
        </div>
    </div>
<?php endif; ?>