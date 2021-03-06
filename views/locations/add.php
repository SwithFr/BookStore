<?php use Helpers\Html; ?>
<div class="section">
    <p class="ariane"><a href="<?= Html::url('manage', 'librarie'); ?>">Retour</a></p>
    <h2 class="section__title">Ajouter un emplacement à la bibliothèque</h2>

    <form class="form--add" action="<?= Html::url('add', 'location', ['library'=>$_GET['library']]); ?>"
          method="post">
        <label class="form__label" for="name">Nom de l'emplacement</label>
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