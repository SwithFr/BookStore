<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= D_ASSETS . DS; ?>css/main.css"/>
    <title>BookStore</title>
</head>
<body>
<header class="header header--home">
    <div class="header__content">
        <div class="header__title">
            <p>Une nouvelle manière de découvir,</p>
            <p>partager et lire des livres</p>
        </div>
        <div class="header__login">
            <?php if(!isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])): ?>
                <a href="<?= Html::url('register','user'); ?>" class="link link--white">Créer un compte</a>
                <a href="<?= Html::url('check','user'); ?>" class="link link--white">Connexion</a>
            <?php else: ?>
                <a href="<?= Html::url('account','user'); ?>" class="link link--white">Mon compte</a>
                <a href="<?= Html::url('disconnect','user'); ?>" class="link link--white">Déconnexion</a>
            <?php endif; ?>
        </div>
    </div>
</header>