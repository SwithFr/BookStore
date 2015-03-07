<nav id="nav" class="nav">
    <div class="nav__content">
        <h1 class="nav__title"><a id="main__title" href="<?= $_SERVER['PHP_SELF']; ?>">Book Store</a></h1>
        <ul class="nav__menu">
            <li class="nav__menu__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=a">Auteurs</a></li>
            <li class="nav__menu__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=a">Editeurs</a></li>
            <li class="nav__menu__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=genre">Genres</a></li>
            <li class="nav__menu__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=popular&e=book">Classement</a></li>
            <li class="nav__menu__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=library">Bibliothèques</a></li>
        </ul>
    </div>
</nav>