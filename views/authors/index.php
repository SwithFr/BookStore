<?php require(D_VIEWS . DS . 'elements' . DS . 'authors-form.php'); use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un auteur</h2>
    </div>
    <ul class="filter__list">
        <?php for($i='a'; $i<='z'; $i++): ?>
            <li class="filter__item">
                <?php if(in_array(ucfirst($i),$data['letters'])): ?>
                    <a href="<?= Html::url('index','author',['letter'=>$i]); ?>" class="dispo-letter<?= ($data['letter'] == $i )?' filter--active':''; ?>"><?= ucfirst($i); ?></a>
                <?php else: ?>
                    <?= ucfirst($i); ?>
                <?php endif; ?>
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
                        <a href="<?= $author->link(); ?>"><?= $author->name(); ?></a>
                    </h3>
                    <div class="author">
                        <p class="section__block__year"><?= $author->date(); ?></p>
                        <p class="section__block__content">
                            <?= $author->sumUp(250); ?>
                        </p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>