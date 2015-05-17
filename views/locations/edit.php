<?php use Helpers\Html; ?>
<div class="section">
    <p class="ariane"><a href="<?= Html::url('manage', 'librarie'); ?>">Retour</a></p>
    <h2 class="section__title">Editer un emplacement</h2>

    <form class="form--add" action="<?= Html::url('edit', 'location', ['id' => $data['location']->id]); ?>"
          method="post">
        <label class="form__label" for="name">Nom de l'emplacement</label>
        <?= isset($data['errors']['name']) ? '<span class="has-error">' . $data['errors']['name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="name"
               id="name"
               value="<?= isset($data['location']->name) ? $data['location']->name : ''; ?>"/>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Editer cet emplacement"/>
    </form>
</div>