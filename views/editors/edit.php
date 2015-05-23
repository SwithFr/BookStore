<?php use Helpers\Html; ?>
<div class="section">
    <p class="ariane"><a href="<?= Html::url('manage', 'editor'); ?>">Retour</a></p>

    <h2 class="section__title">Editer un éditeur</h2>

    <form class="form--add" action="<?= Html::url('edit', 'editor', ['id'=>$data['editor']->id]); ?>" method="post" enctype="multipart/form-data">
        <label class="form__label" for="name">Nom de l'éditeur</label>
        <?= isset($data['errors']['name']) ? '<span class="has-error">' . $data['errors']['name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="name"
               id="name"
               value="<?= $data['editor']->name; ?>"/>

        <label class="form__label" for="website">Adresse du site web</label>
        <?= isset($data['errors']['website']) ? '<span class="has-error">' . $data['errors']['website'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="website"
               id="website"
               value="<?= $data['editor']->website; ?>"/>


        <label class="form__label" for="history">Historique</label>
        <?= isset($data['errors']['history']) ? '<span class="has-error">' . $data['errors']['history'] . '</span>' : ''; ?></span>
        <textarea class="form__textarea"
                  name="history"
                  id="history"><?= $data['editor']->history; ?></textarea>

        <label class="form__label" for="img">Image / logo de l'éditeur</label>
        <?= isset($data['errors']['img']) ? '<span class="has-error">' . $data['errors']['img'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="file"
               name="img"
               id="img"/>

        <img src="<?= $data['editor']->img; ?>"
             class="editor__img--small"/>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Editer cet éditeur"/>
    </form>
</div>