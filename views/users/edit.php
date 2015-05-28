<?php use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Editez vos informations</h2>
    </div>

    <form class="form--add" action="<?= Html::url('edit', 'user'); ?>" method="post">
        <label class="form__label" for="login">Votre identifiant :</label>
        <?= isset($data['errors']['login']) ? '<span class="has-error">' . $data['errors']['login'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--small" type="text" name="login" id="login"
               value="<?= $data['user']->login; ?>"/>

        <label class="form__label" for="email">Votre email :</label>
        <?= isset($data['errors']['email']) ? '<span class="has-error">' . $data['errors']['email'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--small" type="text" name="email" id="email"
               value="<?= $data['user']->email; ?>"/>

        <label class="form__label" for="chgPassword">Changez votre mot de passe <span class="section__block__infos">(laissez vide si vous ne voulez pas changer)</span> :</label>
        <?= isset($data['errors']['passwords']) ? '<span class="has-error">' . $data['errors']['passwords'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--small" type="password" name="chgPassword" id="chgPassword"
               />

        <label class="form__label" for="confirm">Confirmez le changement :</label>
        <?= isset($data['errors']['passwords']) ? '<span class="has-error">' . $data['errors']['passwords'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--small" type="password" name="confirm" id="confirm"
               />

        <input class="form__submit btn btn--send"
               type="submit"
               value="Modifier mes informations"/>
    </form>
</div>