<?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un auteur</h2>
    </div>
    <ul class="filter__list">
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=a" <?= ($data['letter'] == 'a' )?'class="filter--active"':''; ?>>A</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=b" <?= ($data['letter'] == 'b' )?'class="filter--active"':''; ?>>B</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=c" <?= ($data['letter'] == 'c' )?'class="filter--active"':''; ?>>C</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=d" <?= ($data['letter'] == 'd' )?'class="filter--active"':''; ?>>D</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=e" <?= ($data['letter'] == 'e' )?'class="filter--active"':''; ?>>E</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=f" <?= ($data['letter'] == 'f' )?'class="filter--active"':''; ?>>F</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=g" <?= ($data['letter'] == 'g' )?'class="filter--active"':''; ?>>G</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=h" <?= ($data['letter'] == 'h' )?'class="filter--active"':''; ?>>H</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=i" <?= ($data['letter'] == 'i' )?'class="filter--active"':''; ?>>I</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=j" <?= ($data['letter'] == 'j' )?'class="filter--active"':''; ?>>J</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=k" <?= ($data['letter'] == 'k' )?'class="filter--active"':''; ?>>K</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=l" <?= ($data['letter'] == 'l' )?'class="filter--active"':''; ?>>L</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=m" <?= ($data['letter'] == 'm' )?'class="filter--active"':''; ?>>M</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=n" <?= ($data['letter'] == 'n' )?'class="filter--active"':''; ?>>N</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=o" <?= ($data['letter'] == 'o' )?'class="filter--active"':''; ?>>O</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=p" <?= ($data['letter'] == 'p' )?'class="filter--active"':''; ?>>P</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=q" <?= ($data['letter'] == 'q' )?'class="filter--active"':''; ?>>Q</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=r" <?= ($data['letter'] == 'r' )?'class="filter--active"':''; ?>>R</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=s" <?= ($data['letter'] == 's' )?'class="filter--active"':''; ?>>S</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=t" <?= ($data['letter'] == 't' )?'class="filter--active"':''; ?>>T</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=u" <?= ($data['letter'] == 'u' )?'class="filter--active"':''; ?>>U</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=v" <?= ($data['letter'] == 'v' )?'class="filter--active"':''; ?>>V</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=w" <?= ($data['letter'] == 'w' )?'class="filter--active"':''; ?>>W</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=x" <?= ($data['letter'] == 'x' )?'class="filter--active"':''; ?>>X</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=y" <?= ($data['letter'] == 'y' )?'class="filter--active"':''; ?>>Y</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=author&letter=z" <?= ($data['letter'] == 'z' )?'class="filter--active"':''; ?>>Z</a></li>
    </ul>
    <div class="authors">
        <?php if(empty($data['authors'])): ?>
            <h2>Aucun auteur trouvé !</h2>
        <?php endif; ?>
        <ul class="authors__list">
            <?php foreach($data['authors'] as $author): ?>
                <li class="section__block author__list__item">
                    <h3 class="section__block__title"><a href="./authorSingle.html"><?= $author->first_name . ' ' . $author->last_name; ?></a></h3>
                    <div class="author animated fadeInDown">
                        <p class="section__block__year"><?= $author->date_birth; ?> - <?= $author->date_death; ?></p>
                        <p class="section__block__content">
                            <?= Text::cut($author->bio,250); ?>
                        </p><a href="./authorSingle.html" class="section__readMore">Lire plus</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</div>