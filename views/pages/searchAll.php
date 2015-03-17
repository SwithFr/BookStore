<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php');
use Helpers\Html;

?>
<div class="section">
    <?php if (!isset($data['request'])): ?>
        <div class="section__header">
            <h2 class="section__title">Aucune recherche formulée !</h2>
        </div>
    <?php else: ?>
        <div class="section__header">
            <h2 class="section__title">Résultats de la recherche pour <span
                    class="request"><?= $data['request']; ?></span></h2>
        </div>
        <?php if (empty($data['data']['libraries'])): ?>
            <h2 class="noResult">Aucun livre trouvé !</h2>
        <?php else: ?>
            <div class="section__block results">
                <h2 class="results__title">Le(s) Livre(s)</h2>
                <?php foreach ($data['data']['libraries'] as $k => $v): ?>
                    <p class="library">
                        Dans la bibliothèque : <a class="library__name" href="<?= Html::url('view', 'librarie', ['id' => $v['id']]); ?>"><?= $k; ?></a>
                    </p>
                    <?php foreach ($v as $book): ?>
                        <?php if (!is_numeric($book)): ?>
                            <h3>
                                <a class="results__link" href="<?= Html::url('view', 'book', ['id' => $book->id]); ?>"><?= $book->title; ?></a>
                            </h3>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($data['data']['authors'])): ?>
            <h2 class="noResult">Aucun auteur trouvé !</h2>
        <?php else: ?>
            <div class="section__block results">
                <h2 class="results__title">Le(s) auteur(s)</h2>
                <?php foreach ($data['data']['authors'] as $author): ?>
                    <h3 class="results__link">
                        <a href="<?= Html::url('view', 'author', ['id' => $author->id]); ?>"><?= $author->first_name . ' ' . $author->last_name; ?></a>
                    </h3>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($data['data']['genres'])): ?>
            <h2 class="noResult">Aucun genre trouvé !</h2>
        <?php else: ?>
            <div class="section__block results">
                <h2 class="results__title">Le(s) genre(s)</h2>
                <?php foreach ($data['data']['genres'] as $genre): ?>
                    <h3 class="results__link">
                        <a href="<?= Html::url('view', 'genre', ['id' => $genre->id]); ?>"><?= $genre->name; ?></a>
                    </h3>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>