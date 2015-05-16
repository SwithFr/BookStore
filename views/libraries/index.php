<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php');
use Helpers\Html;

?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Les bibliothèques</h2>
    </div>
    <ul>
        <?php foreach ($data['libraries'] as $library): ?>
            <li>
                <a href="<?= Html::url('view', 'librarie', ['id' => $library->id]); ?>"><?= $library->name; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>