<?php require(D_VIEWS . DS . 'elements' . DS . 'editors-form.php'); use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un editeur</h2>
    </div>
    <ul class="filter__list">
        <?php for($i='a'; $i<='z'; $i++): ?>
            <li class="filter__item">
                <?php if(in_array(ucfirst($i),$data['letters'])): ?>
                    <a href="<?= Html::url('index','editor',['letter'=>$i]); ?>" class="dispo-letter<?= ($data['letter'] == $i )?' filter--active':''; ?>"><?= ucfirst($i); ?></a>
                <?php else: ?>
                    <?= ucfirst($i); ?>
                <?php endif; ?>
                <?php if($i=='z'){break;}; ?>
            </li>
        <?php endfor; ?>
    </ul>
    <?php if(empty($data['editors'])): ?>
        <h2 class="noResult">Aucun éditeur trouvé !</h2>
    <?php endif; ?>
    <ul class="editors__list">
        <?php foreach($data['editors'] as $editor): ?>
            <li class="section__block  editors__list__item">
                <img src="<?= D_ASSETS . DS . 'img' . DS . $editor->img; ?>" class="editor__img">
                <h2 class="editor__title"><a href="<?= Html::url('view', 'editor', ['id' => $editor->id]); ?>"><?= $editor->name; ?></a></h2>
                <span class="editor__infos">30 livres</span>
                <p><?= $editor->history; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>