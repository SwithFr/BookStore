<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Se connecter</h2>

    <form class="form--login" action="<?= Html::url('check', 'user'); ?>" method="post">
        <label class="form__label" for="login">Nom d'utilisateur</label>
        <?= isset($data['errors']['login']) ? '<span class="has-error">' . $data['errors']['login'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="login" id="login"
               value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>"/>

        <label class="form__label" for="password">Mot de passe</label>
        <?= isset($data['errors']['password']) ? '<span class="has-error">' . $data['errors']['password'] . '</span>' : ''; ?>
        <input class="form__input form__input--large" type="password" name="password" id="password"/>

        <label class="form__label" for="remember">Se souvenir de moi</label>
        <input class="form__input form__input--large" type="checkbox" name="remember" id="remember"/>

        <input class="form__submit btn btn--send" type="submit" value="Se connecter"/>
        <a href="<?= Html::url('register','user'); ?>">Pas encore de compte ? Enregistrez-vous.</a>
    </form>
</div>