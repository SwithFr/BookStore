<div class="section">
    <form action="<?= Html::url('check','user'); ?>" method="post">
        <label for="login">Login</label>
        <input type="text" name="login" id="login"/>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"/>
        <label for="remember">Se souvenir de moi</label>
        <input type="checkbox" name="remember" id="remember"/>
        <input type="submit" value="Se connecter"/>
    </form>
</div>