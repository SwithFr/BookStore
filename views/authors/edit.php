<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Editer un auteur</h2>

    <form class="form--add" action="<?= Html::url('edit', 'author', ['id' => $data['author']->id]); ?>" method="post"
          enctype="multipart/form-data">
        <label class="form__label" for="first_name">Prénom de l'auteur</label>
        <?= isset($data['errors']['first_name']) ? '<span class="has-error">' . $data['errors']['first_name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="first_name"
               id="first_name"
               value="<?= $data['author']->first_name; ?>"/>

        <label class="form__label" for="last_name">Nom de l'auteur</label>
        <?= isset($data['errors']['last_name']) ? '<span class="has-error">' . $data['errors']['last_name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="last_name"
               id="last_name"
               value="<?= $data['author']->last_name; ?>"/>


        <label class="form__label" for="bio">Biographie</label>
        <?= isset($data['errors']['bio']) ? '<span class="has-error">' . $data['errors']['bio'] . '</span>' : ''; ?></span>
        <textarea class="form__textarea"
                  name="bio"
                  rows="8"
                  id="bio"><?= $data['author']->bio; ?></textarea>

        <label class="form__label" for="img">Photo de l'auteur</label>
        <?= isset($data['errors']['img']) ? '<span class="has-error">' . $data['errors']['img'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="file"
               name="img"
               id="img"/>
        <img src="<?= $data['author']->img; ?>"
             class="editor__img--small"
             alt="Photographie de <?= $data['author']->first_name . ' ' . $data['author']->last_name; ?>"/>

        <label class="form__label" for="date_birth">Date de naissance</label>
        <?= isset($data['errors']['date_birth']) ? '<span class="has-error">' . $data['errors']['date_birth'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="date_birth"
               id="date_birth"
               placeholder="AAAA-MM--JJ"
               value="<?= $data['author']->date_birth; ?>"/>

        <label class="form__label" for="date_death">Date de décès</label>
        <?= isset($data['errors']['date_death']) ? '<span class="has-error">' . $data['errors']['date_death'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="date_death"
               id="date_death"
               placeholder="AAAA-MM--JJ"
               value="<?= $data['author']->date_death; ?>"/>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Modifier cet auteur"/>
    </form>
</div>