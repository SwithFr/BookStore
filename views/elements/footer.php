<?php use Helpers\Html; ?>
<footer class="footer">
    <div class="footer__content">
        <h2 class="footer__title">Book Store</h2>
        <nav class="nav">
            <div class="nav__content">
                <ul class="nav__menu">
                    <li class="nav__menu__item"><a href="<?= Html::url('index', 'author', ['letter' => 'a']); ?>">Auteurs</a>
                    </li>
                    <li class="nav__menu__item"><a href="<?= Html::url('index', 'editor', ['letter' => 'a']); ?>">Editeurs</a>
                    </li>
                    <li class="nav__menu__item"><a href="<?= Html::url('index', 'genre'); ?>">Genres</a></li>
                    <li class="nav__menu__item"><a href="<?= Html::url('populars', 'book'); ?>">Classement</a></li>
                    <li class="nav__menu__item"><a href="<?= Html::url('index', 'librarie'); ?>">Bibliothèques</a></li>
                </ul>
            </div>
        </nav>
    </div>
</footer>
</body>
</html>
<script type="text/javascript" src="<?= D_ASSETS . DS; ?>js/main.js"></script>