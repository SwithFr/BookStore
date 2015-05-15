<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php');
use Helpers\Html;

?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Les livres par genres</h2>
    </div>
    <?php foreach ($data['genres'] as $genre): ?>
        <div class="genre">
            <h2 class="section__block__title title--linked">
                <a href="<?= Html::url('view','genre',['id'=>$genre->id]); ?>"><?= $genre->name; ?></a>
            </h2>
            <?php if(!empty($genre->books)): ?>
                <?php foreach ($genre->books as $book): ?>
                    <p>
                        <a class="results__link" href="<?= Html::url('view', 'book', ['id' => $book->id]); ?>"><?= $book->title; ?></a>
                    </p>
                <?php endforeach; ?>
                <p><a class="results__link" href="<?= Html::url('view','genre',['id'=>$genre->id]); ?>">&hellip;</a></p>
            <?php else: ?>
                <p class="empty">Pas de livre dans cette catégorie</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>