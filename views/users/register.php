<div class="section">
    <form action="<?= Html::url('register','user'); ?>" method="post">
        <label for="login">Login</label>
        <span><?= isset($data['errors']['login']) ? $data['errors']['login'] : ''; ?></span>
        <input type="text" name="login" id="login" value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>"/>
        <label for="email">Email</label>
        <span><?= isset($data['errors']['email']) ? $data['errors']['email'] : ''; ?></span>
        <input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"/>
        <label for="password">Mot de passe</label>
        <span><?= isset($data['errors']['password']) ? $data['errors']['password'] : ''; ?></span>
        <input type="password" name="password" id="password"/>
        <input type="submit" value="Se connecter"/>
    </form>
</div>