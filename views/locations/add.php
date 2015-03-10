<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Ajouter un emplacement à la bibliothèque</h2>

    <form class="form--add" action="<?= Html::url('add', 'location'); ?>&library=<?= $data['library_id']; ?>" method="post">
        <label class="form__label" for="name">Nom de l'éditeur</label>
        <?= isset($data['errors']['name']) ? '<span class="has-error">' . $data['errors']['name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="name"
               id="name"
               value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"/>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Ajouter cet emplacement"/>
    </form>
</div>