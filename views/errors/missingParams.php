<?php use Helpers\Html; ?>
<div class="unauthorized">
    <div class="content">
        <h1>Minute papillon</h1>

        <p class="message"><?= $data['message']; ?></p>
        <a class="btn--back" href="<?= Html::url('index', 'book'); ?>">Retour au site</a>
    </div>
</div>