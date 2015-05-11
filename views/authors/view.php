<?php
use Helpers\Html;

$v = new \Behaviors\Votable();
?>
<?php if ($data['author']): ?>
    <div class="section">
        <div class="section__header">
            <h2 class="section__title"><?= $data['author']->name(); ?></h2>

            <div class="section__block bio">
                <p class="section__block__year"><?= $data['author']->date(); ?></p>

                <div class="section__block__content">
                    <?= $data['author']->bio; ?>
                </div>
            </div>
            <div class="section__block infos">
                <?= $data['author']->img(); ?>
                <?php if (!empty($data['books'])): ?>
                    <h3>Voir ses livres</h3>
                    <ul id="books__list">
                        <?php foreach ($data['books'] as $book): ?>
                            <li>
                                <a href="<?= $book->link(); ?>"><?= $book->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="votes">
                    <?php if( \Components\Session::isLogged() ): ?>
                        <div class="<?= $v->getClass('authors', $data['author']->id); ?>">
                            <a class="voteUp" href="<?= Html::url('voteUp', 'author', ['ref_id' => $data['author']->id]); ?>">J'aime cet auteur</a> /
                            <a class="voteDown" href="<?= Html::url('voteDown', 'author', ['ref_id' => $data['author']->id]); ?>">Je n'aime pas cet auteur</a>
                        </div>
                    <?php else: ?>
                        <p class="section__block__infos">Connectez-vous ou créez un compte pour voter pour cet auteur</p>
                    <?php endif; ?>
                    <p><span class="nb"><?= $data['author']->vote; ?></span> % de satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>