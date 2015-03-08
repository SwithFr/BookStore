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
            <a href="<?= Html::url('register','user'); ?>" class="btn btn--white">Créer un compte</a>
            <a href="<?= Html::url('chceck','user'); ?>" class="btn btn--white">Connexion</a>
        </div>
    </div>
</header>