<?php use Helpers\Html; ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Editez vos informations</h2>
    </div>

    <form class="form--add" action="<?= Html::url('edit', 'user'); ?>" method="post">
        <label class="form__label" for="login">Votre identifiant :</label>
        <input class="form__input form__input--large" type="text" name="login" id="login"
               value="<?= $data['user']->login; ?>"/>
        <label class="form__label" for="email">Votre email :</label>
        <input class="form__input form__input--large" type="text" name="email" id="email"
               value="<?= $data['user']->email; ?>"/>
        <label class="form__label" for="password">Changez votre mot de passe <span class="section__block__infos">(laissez vide si vous ne voulez pas changer)</span> :</label>
        <input class="form__input form__input--large" type="password" name="password" id="password"
               value="fakePasswordForLol"/>
        <label class="form__label" for="login">Confirmez le changement :</label>
        <input class="form__input form__input--large" type="text" name="login" id="login"
               />
        <input class="form__submit btn btn--send"
               type="submit"
               value="Modifier mes informations"/>
    </form>
</div>