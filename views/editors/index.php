<?php require(D_VIEWS . DS . 'elements' . DS . 'editors-form.php'); use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un editeur</h2>
    </div>
    <ul class="filter__list">
        <?php for($i='a'; $i<='z'; $i++): ?>
            <li class="filter__item">
                <a href="<?= Html::url('index','editor',['letter'=>$i]); ?>" <?= ($data['letter'] == $i )?'class="filter--active"':''; ?>><?= ucfirst($i); ?></a>
                <?php if($i=='z'){break;}; ?>
            </li>
        <?php endfor; ?>

    </ul>
    <div class="section__block">
        <?php if(empty($data['editors'])): ?>
            <h2>Aucun éditeur trouvé !</h2>
        <?php endif; ?>
        <ul class="editors__list">
            <?php foreach($data['editors'] as $editor): ?>
                <li class="editors__list__item">
                    <img src="<?= D_ASSETS . DS . 'img' . DS . $editor->img; ?>" class="editor__img">
                    <h2 class="editor__title"><a href="./editorSingle.html"><?= $editor->name; ?></a></h2>
                    <span class="editor__infos">30 livres</span>
                    <p><?= $editor->history; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>