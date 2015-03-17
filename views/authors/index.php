<?php require(D_VIEWS . DS . 'elements' . DS . 'authors-form.php'); use Helpers\Text; use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un auteur</h2>
    </div>
    <ul class="filter__list">
        <?php for($i='a'; $i<='z'; $i++): ?>
            <li class="filter__item">
                <a href="<?= Html::url('index','author',['letter'=>$i]); ?>" <?= ($data['letter'] == $i )?'class="filter--active"':''; ?>><?= ucfirst($i); ?></a>
                <?php if($i=='z'){break;}; ?>
            </li>
        <?php endfor; ?>
    </ul>
    <div class="authors">
        <?php if(empty($data['authors'])): ?>
            <h2 class="noResult">Aucun auteur trouvé !</h2>
        <?php endif; ?>
        <ul class="authors__list">
            <?php foreach($data['authors'] as $author): ?>
                <li class="section__block author__list__item">
                    <h3 class="section__block__title">
                        <a href="<?= Html::url('view','author',['id'=>$author->id]); ?>"><?= $author->first_name . ' ' . $author->last_name; ?></a>
                    </h3>
                    <div class="author">
                        <p class="section__block__year"><?= $author->date_birth; ?> - <?= $author->date_death; ?></p>
                        <p class="section__block__content">
                            <?= Text::cut($author->bio,250); ?>
                        </p><a href="<?= Html::url('view','author',['id'=>$author->id]); ?>" class="section__readMore author__readMore">Lire plus</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</div>