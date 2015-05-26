<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php');
use Components\Cache;
use Helpers\Html;

?>
<?php if (!Cache::start('index')): ?>
    <div class="section vedettes">
        <div class="section__header">
            <h2 class="section__title title--inline">Livres les mieux notés :</h2>
            <a href="<?= Html::url('populars', 'book'); ?>" class="section__readMore">Voir tout le classement</a>
        </div>
        <?php foreach ($data['books'] as $book): ?>
            <div class="section__block">
                <?= $book->img(); ?>

                <h3 class="section__block__title"><a
                        href="<?= $book->link() ?>"><?= $book->title; ?></a></h3>

                <p class="section__block__author"><?= $book->getAuthorName(); ?></p>

                <p class="section__block__content">
                    <?= $book->sumUp() ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="section author">
        <div class="section__header">
            <h2 class="section__title title--inline">Auteur le mieux noté</h2>
            <a href="<?= $data['author']->link(); ?>" class="section__readMore">Voir plus
                du même auteur</a>
        </div>
        <div class="section__block">
            <h3 class="section__block__title"><a
                    href="<?= $data['author']->link(); ?>"><?= $data['author']->name(); ?></a>
            </h3>

            <p class="section__block__year"><?= $data['author']->date(); ?></p>

            <p class="section__block__content">
                <?= $data['author']->sumUp(); ?>
            </p>

            <div class="author__count">
                <p><?= $data['author']->name(); ?> a écrit <a href="<?= $data['author']->link(); ?>#books__list"><span
                            class="nb nb-p"><?= $data['author']->book_count; ?></span></a> livres</p>

                <p><?= $data['author']->score(); ?></p>
            </div>
        </div>
        <div class="section__block">
            <?= $data['author']->img(); ?>
        </div>
    </div>
<?php endif; ?>
<?= Cache::end(); ?>