<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Ajouter un éditeur</h2>

    <form class="form--add" action="<?= Html::url('add', 'editor'); ?>" method="post" enctype="multipart/form-data">
        <label class="form__label" for="name">Nom de l'éditeur</label>
        <?= isset($data['errors']['name']) ? '<span class="has-error">' . $data['errors']['name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="name"
               id="name"
               value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"/>

        <label class="form__label" for="website">Adresse du site web</label>
        <?= isset($data['errors']['website']) ? '<span class="has-error">' . $data['errors']['website'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="website"
               id="website"
               value="<?= isset($_POST['website']) ? $_POST['website'] : ''; ?>"/>


        <label class="form__label" for="history">Historique</label>
        <?= isset($data['errors']['history']) ? '<span class="has-error">' . $data['errors']['history'] . '</span>' : ''; ?></span>
        <textarea class="form__textarea"
                  name="history"
                  id="history"><?= isset($_POST['history']) ? $_POST['history'] : ''; ?></textarea>

        <label class="form__label" for="img">Image / logo de l'éditeur</label>
        <?= isset($data['errors']['img']) ? '<span class="has-error">' . $data['errors']['img'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="file"
               name="img"
               id="img"
               value="<?= isset($_POST['img']) ? $_POST['img'] : ''; ?>"/>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Ajouter cet auteur"/>
    </form>
</div>