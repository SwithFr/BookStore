<div class="section">
    <form action="<?= Html::url('check','user'); ?>" method="post">
        <label for="login">Login</label>
        <span><?= isset($data['errors']['login']) ? $data['errors']['login'] : ''; ?></span>
        <input type="text" name="login" id="login" value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>"/>
        <label for="password">Mot de passe</label>
        <span><?= isset($data['errors']['password']) ? $data['errors']['password'] : ''; ?></span>
        <input type="password" name="password" id="password"/>
        <label for="remember">Se souvenir de moi</label>
        <input type="checkbox" name="remember" id="remember"/>
        <input type="submit" value="Se connecter"/>
    </form>
</div>