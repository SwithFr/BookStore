<?php
use Helpers\Html;
use Components\Session;
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
                    <h3 class="head__list">Liste de ses livres</h3>
                    <ul class="author__books__list">
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
                    <p><?= $data['author']->score(); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <h2 class="section__title">Les commentaires :</h2>
        <?php if(!empty($data['comments'])): ?>
            <?php foreach($data['comments'] as $comment): ?>
                <div class="comment">
                    <p>Commentaire écrit par : <span class="comment__author"><?= $comment->login; ?></span></p>
                    <p class="comment__content"><?= $comment->comment; ?></p>
                    <?php if($comment->user_id == Session::getId()): ?>
                        <div class="comment__actions">
                            <?= $comment->deleteLink(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?= Html::paginate($data['nbPages'],'view','author',['id'=>$data['author']->id]); ?>
        <?php else: ?>
            <p class="section__block__infos">Encore aucun commentaire sur ce livre, soyez le premier à en rédiger un.</p>
        <?php endif; ?>

        <?php if(Session::isLogged()): ?>
            <form action="<?= Html::url('add','comment',['ref'=>'author','ref_id'=>$data['author']->id]); ?>" method="post" class="form--add">
                <label for="text">Votre commentaire :</label>
                <?php if(Session::hasError('text')): ?>
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