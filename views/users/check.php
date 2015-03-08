<div class="section">
    <form action="<?= Html::url('check','user'); ?>" method="post">
        <label for="login">Login</label>
        <input type="text" name="login" id="login"/>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"/>
        <input type="submit" value="Se connecter"/>
    </form>
</div>