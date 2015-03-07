<?php require(D_VIEWS . DS . 'elements' . DS . 'editors-form.php'); ?>
<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un editeur</h2>
    </div>
    <ul class="filter__list">
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=a" <?= ($data['letter'] == 'a' )?'class="filter--active"':''; ?>>A</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=b" <?= ($data['letter'] == 'b' )?'class="filter--active"':''; ?>>B</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=c" <?= ($data['letter'] == 'c' )?'class="filter--active"':''; ?>>C</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=d" <?= ($data['letter'] == 'd' )?'class="filter--active"':''; ?>>D</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=e" <?= ($data['letter'] == 'e' )?'class="filter--active"':''; ?>>E</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=f" <?= ($data['letter'] == 'f' )?'class="filter--active"':''; ?>>F</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=g" <?= ($data['letter'] == 'g' )?'class="filter--active"':''; ?>>G</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=h" <?= ($data['letter'] == 'h' )?'class="filter--active"':''; ?>>H</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=i" <?= ($data['letter'] == 'i' )?'class="filter--active"':''; ?>>I</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=j" <?= ($data['letter'] == 'j' )?'class="filter--active"':''; ?>>J</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=k" <?= ($data['letter'] == 'k' )?'class="filter--active"':''; ?>>K</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=l" <?= ($data['letter'] == 'l' )?'class="filter--active"':''; ?>>L</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=m" <?= ($data['letter'] == 'm' )?'class="filter--active"':''; ?>>M</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=n" <?= ($data['letter'] == 'n' )?'class="filter--active"':''; ?>>N</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=o" <?= ($data['letter'] == 'o' )?'class="filter--active"':''; ?>>O</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=p" <?= ($data['letter'] == 'p' )?'class="filter--active"':''; ?>>P</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=q" <?= ($data['letter'] == 'q' )?'class="filter--active"':''; ?>>Q</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=r" <?= ($data['letter'] == 'r' )?'class="filter--active"':''; ?>>R</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=s" <?= ($data['letter'] == 's' )?'class="filter--active"':''; ?>>S</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=t" <?= ($data['letter'] == 't' )?'class="filter--active"':''; ?>>T</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=u" <?= ($data['letter'] == 'u' )?'class="filter--active"':''; ?>>U</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=v" <?= ($data['letter'] == 'v' )?'class="filter--active"':''; ?>>V</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=w" <?= ($data['letter'] == 'w' )?'class="filter--active"':''; ?>>W</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=x" <?= ($data['letter'] == 'x' )?'class="filter--active"':''; ?>>X</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=y" <?= ($data['letter'] == 'y' )?'class="filter--active"':''; ?>>Y</a></li>
        <li class="filter__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=editor&letter=z" <?= ($data['letter'] == 'z' )?'class="filter--active"':''; ?>>Z</a></li>
    </ul>
    <div class="section__block">
        <ul class="editors__list">
            <?php foreach($data['editors'] as $editor): ?>
                <li class="editors__list__item"><a href="./editorSingle.html"><?= $editor->name; ?></a>
                    <p class="editor__infos">30 livres</p><img src="<?= D_ASSETS . DS . 'img' . DS . $editor->img; ?>" class="editor__img">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>