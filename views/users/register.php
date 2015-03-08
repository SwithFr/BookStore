<div class="section">
    <h2 class="section__title">Créer un compte</h2>

    <form class="form--register" action="<?= Html::url('register', 'user'); ?>" method="post">
        <label class="form__label" for="login">Login</label>
        <?= isset($data['errors']['login']) ? '<span class="has-error">' . $data['errors']['login'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="login" id="login"
               value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>"/>

        <label class="form__label" for="email">Email</label>
        <?= isset($data['errors']['email']) ? '<span class="has-error">' . $data['errors']['email'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="email" name="email" id="email"
               value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"/>

        <label class="form__label" for="password">Mot de passe</label>
        <?= isset($data['errors']['password']) ? '<span class="has-error">' . $data['errors']['password'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="password" name="password" id="password"/>

        <input class="form__submit btn btn--send" type="submit" value="Se connecter"/>
    </form>
</div>