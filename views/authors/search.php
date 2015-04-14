<?php require(D_VIEWS . DS . 'elements' . DS . 'authors-form.php');
use Helpers\Html;

?>
<div class="section">
    <?php if (!$data['request']): ?>
        <div class="section__header">
            <h2 class="section__title">Aucune recherche formulée !</h2>
        </div>
    <?php else: ?>
        <div class="section__header">
            <h2 class="section__title">Résultats de la recherche pour <span
                    class="request"><?= $data['request']; ?></span></h2>
        </div>
        <?php if (empty($data['authors'])): ?>
            <h2 class="noResult">Aucun auteur trouvé !</h2>
        <?php else: ?>
            <div class="section__block results">
                <?php foreach ($data['authors'] as $author): ?>
                    <h3 class="results__link">
                        <a href="<?= Html::url('view', 'author', ['id' => $author->id]); ?>"><?= $author->first_name . ' ' . $author->last_name; ?></a>
                    </h3>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>