<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Ajouter un auteur</h2>

    <form class="form--add" action="<?= Html::url('add', 'author'); ?>" method="post" enctype="multipart/form-data">
        <label class="form__label" for="first_name">Prénom de l'auteur</label>
        <?= isset($data['errors']['first_name']) ? '<span class="has-error">' . $data['errors']['first_name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="first_name"
               id="first_name"
               value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>"/>

        <label class="form__label" for="last_name">Nom de l'auteur</label>
        <?= isset($data['errors']['last_name']) ? '<span class="has-error">' . $data['errors']['last_name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="last_name"
               id="last_name"
               value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>"/>


        <label class="form__label" for="bio">Biographie</label>
        <?= isset($data['errors']['bio']) ? '<span class="has-error">' . $data['errors']['bio'] . '</span>' : ''; ?></span>
        <textarea class="form__textarea"
                  name="bio"
                  id="bio"><?= isset($_POST['bio']) ? $_POST['bio'] : ''; ?></textarea>

        <label class="form__label" for="img">Photo de l'auteur</label>
        <?= isset($data['errors']['img']) ? '<span class="has-error">' . $data['errors']['img'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="file"
               name="img"
               id="img"
               value="<?= isset($_POST['img']) ? $_POST['img'] : ''; ?>"/>

        <label class="form__label" for="date_birth">Date de naissance</label>
        <?= isset($data['errors']['date_birth']) ? '<span class="has-error">' . $data['errors']['date_birth'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="date_birth"
               id="date_birth"
               placeholder="AAAA-MM--JJ"
               value="<?= isset($_POST['date_birth']) ? $_POST['date_birth'] : ''; ?>"/>

        <label class="form__label" for="date_death">Date de décès</label>
        <?= isset($data['errors']['date_death']) ? '<span class="has-error">' . $data['errors']['date_death'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="date_death"
               id="date_death"
               placeholder="AAAA-MM--JJ"
               value="<?= isset($_POST['date_death']) ? $_POST['date_death'] : ''; ?>"/>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Ajouter cet auteur"/>
    </form>
</div>