<?php
use Helpers\Html;

$v = new \Behaviors\Votable();
?>
<?php if ($data['author']): ?>
    <div id="content" class="content">
        <div class="section">
            <div class="section__header">
                <h2 class="section__title"><?= $data['author']->first_name . ' ' . $data['author']->last_name; ?></h2>

                <div class="section__block bio">
                    <p class="section__block__year"><?= $data['author']->date_birth; ?><?= ($data['author']->date_death !== '') ? ' - ' . $data['author']->date_death : ''; ?></p>

                    <div class="section__block__content">
                        <?= $data['author']->bio; ?>
                    </div>
                </div>
                <div class="section__block infos">
                    <img src="<?= $data['author']->img; ?>" class="section__block__img">
                    <?php if (!empty($data['books'])): ?>
                        <h3>Voir ses livres</h3>
                        <ul id="books__list">
                            <?php foreach ($data['books'] as $book): ?>
                                <li>
                                    <a href="<?= Html::url('view', 'book', ['id' => $book->id]); ?>"><?= $book->title; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if( \Components\Session::isLogged() ): ?>
                        <div class="<?= $v->getClass('authors', $data['author']->id); ?>">
                            <a class="voteUp" href="<?= Html::url('voteUp', 'author', ['ref_id' => $data['author']->id]); ?>">J'aime cet auteur</a> /
                            <a class="voteDown" href="<?= Html::url('voteDown', 'author', ['ref_id' => $data['author']->id]); ?>">Je n'aime pas cet auteur</a>
                        </div>
                    <?php endif; ?>
                    <p>Et il a une note globale de <span class="nb"><?= $data['author']->vote; ?></span> sur 5</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>