<div class="section vedettes">
    <div class="section__header">
        <h2 class="section__title">Livres les mieux notés :</h2><a href="./views/books/byAuthor.html" class="section__readMore">Voir tout le classement</a>
    </div>
    <?php foreach($data['books'] as $book): ?>
        <div class="section__block">
            <img src="./assets/img/<?= $book->img; ?>" class="section__block__img">
            <h3 class="section__block__title"><?= $book->title; ?></h3>
            <p class="section__block__author"><?= $book->first_name . ' ' . $book->last_name; ?></p>
            <p class="section__block__content">
                <?= $book->summary; ?>
            </p>
            <a href="./views/books/single.html" class="section__readMore">En voir plus</a>
        </div>
    <?php endforeach; ?>
</div>
<div class="section author">
    <div class="section__header">
        <h2 class="section__title"><a href="./views/books/byAuthor.html">Auteur le mieux noté</a></h2><a href="./views/books/byAuthor.html" class="section__readMore">Voir plus du même auteur</a>
    </div>
    <div class="section__block">
        <h3 class="section__block__title"><?= $data['author']->first_name . ' ' . $data['author']->last_name; ?></h3>
        <p class="section__block__year"><?= $data['author']->date_birth; ?> - <?= $data['author']->date_death; ?></p>
        <p class="section__block__content">
            <?= $data['author']->bio; ?>
        </p>
        <div class="author__count">
            <p class="nb author__nbBooks"><?= $data['author']->nb_livres; ?></p>
            <p class="nb author__eval">4.5</p>
        </div>
    </div>
    <div class="section__block"><img src="./assets/img/vHugo.jpg" class="section__block__img"></div>
</div>
</div>