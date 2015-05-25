<?php
use Components\Session;
use Helpers\Html;

$isReadLater = $data['book']->isReadLater;
?>
<?php $v = new \Behaviors\Votable(); ?>
<?php if ($data['book']): ?>
    <div class="section">
        <div class="section__header">
            <h2 class="section__title"><?= $data['book']->title; ?></h2>

            <div class="section__block bio">
                <p class="section__block__year">
                    Écrit par <a href="<?= Html::url('view', 'author', ['id' => $data['book']->a_id]); ?>"
                                 class="author__name"><?= $data['book']->first_name . ' ' . $data['book']->last_name; ?></a>
                    et editer par <?= $data['book']->e_name; ?>
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
                    <?php if (Session::isLogged()): ?>
                        <div class="<?= $v->getClass('books', $data['book']->id); ?>">
                            <a class="voteUp"
                               href="<?= Html::url('voteUp', 'book', ['ref_id' => $data['book']->id]); ?>">J'aime ce
                                livre</a> /
                            <a class="voteDown"
                               href="<?= Html::url('voteDown', 'book', ['ref_id' => $data['book']->id]); ?>">Je n'aime
                                pas ce livre</a>
                        </div>
                        <div class="readLaterLinks">
                            <a id="addReadLaterLink"
                               class="<?= $isReadLater ? 'hidden' : 'visible'; ?>"
                               data-book_id="<?= $data['book']->id; ?>"
                               data-user_id="<?= Session::getId(); ?>"
                               href="<?= Html::url('addToReadLater', 'book'); ?>">Ajouter à la
                                liste de lecture</a>
                            <a id="removeReadLaterLink" class="<?= $isReadLater ? 'visible' : 'hidden'; ?>"
                               data-book_id="<?= $data['book']->id; ?>" data-user_id="<?= Session::getId(); ?>"
                               href="<?= Html::url('removeToReadLater', 'book'); ?>">Supprimer de la liste de
                                lecture</a>
                        </div>
                    <?php else: ?>
                        <p class="section__block__infos">Connectez-vous ou créez un compte pour voter pour ce livre.</p>
                    <?php endif; ?>
                    <p><?= $data['book']->score(); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <h2 class="section__title">Les commentaires :</h2>
        <?php if (!empty($data['comments'])): ?>
            <?php foreach ($data['comments'] as $comment): ?>
                <div class="comment">
                    <p>Commentaire écrit par : <span class="comment__author"><?= $comment->login; ?></span></p>

                    <p class="comment__content"><?= $comment->comment; ?></p>
                    <?php if ($comment->user_id == Session::getId()): ?>
                        <div class="comment__actions">
                            <?= $comment->deleteLink(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?= Html::paginate($data['nbPages'], 'view', 'book', ['id' => $data['book']->id]); ?>
        <?php else: ?>
            <p class="section__block__infos">Encore aucun commentaire sur ce livre, soyez le premier à en rédiger
                un.</p>
        <?php endif; ?>

        <?php if (Session::isLogged()): ?>
            <form action="<?= Html::url('add', 'comment', ['ref' => 'book', 'ref_id' => $data['book']->id]); ?>"
                  method="post" class="form--add">
                <label for="text">Votre commentaire :</label>
                <?php if (Session::hasError('text')): ?>
                    <span class="has-error"><?= Session::getError('text'); ?></span>
                <?php endif; ?>
                <textarea class="form__textarea" name="text" id="test" rows="5"></textarea>
                <input type="submit" value="Commenter" class="btn btn--send"/>
            </form>
        <?php else: ?>
            <p class="section__block__infos">Connectez-vous ou créez un compte pour commenter ce livre.</p>
        <?php endif; ?>
    </div>

<?php endif; ?>