<div class="section">
    <div class="section__header">
        <h2 class="section__title">Selectionnez un auteur</h2>
    </div>
    <ul class="filter__list">
        <li class="filter__item"><a href="./authorsList.html" class="filter--active">A</a></li>
        <li class="filter__item"><a href="./authorsList.html">B</a></li>
        <li class="filter__item"><a href="./authorsList.html">C</a></li>
        <li class="filter__item"><a href="./authorsList.html">D</a></li>
        <li class="filter__item"><a href="./authorsList.html">F</a></li>
        <li class="filter__item"><a href="./authorsList.html">G</a></li>
        <li class="filter__item"><a href="./authorsList.html">H</a></li>
        <li class="filter__item"><a href="./authorsList.html">I</a></li>
        <li class="filter__item"><a href="./authorsList.html">J</a></li>
        <li class="filter__item"><a href="./authorsList.html">K</a></li>
        <li class="filter__item"><a href="./authorsList.html">L</a></li>
        <li class="filter__item"><a href="./authorsList.html">M</a></li>
        <li class="filter__item"><a href="./authorsList.html">N</a></li>
        <li class="filter__item"><a href="./authorsList.html">O</a></li>
        <li class="filter__item"><a href="./authorsList.html">P</a></li>
        <li class="filter__item"><a href="./authorsList.html">Q</a></li>
        <li class="filter__item"><a href="./authorsList.html">R</a></li>
        <li class="filter__item"><a href="./authorsList.html">S</a></li>
        <li class="filter__item"><a href="./authorsList.html">T</a></li>
        <li class="filter__item"><a href="./authorsList.html">U</a></li>
        <li class="filter__item"><a href="./authorsList.html">V</a></li>
        <li class="filter__item"><a href="./authorsList.html">W</a></li>
        <li class="filter__item"><a href="./authorsList.html">X</a></li>
        <li class="filter__item"><a href="./authorsList.html">Y</a></li>
        <li class="filter__item"><a href="./authorsList.html">Z</a></li>
    </ul>
    <div class="authors">
        <ul class="authors__list">
            <?php foreach($data['authors'] as $author): ?>
                <li class="section__block author__list__item">
                    <h3 class="section__block__title"><a href="./authorSingle.html"><?= $author->first_name . ' ' . $author->last_name; ?></a></h3>
                    <div class="author animated fadeInDown">
                        <p class="section__block__year"><?= $author->date_birth; ?> - <?= $author->date_death; ?></p>
                        <p class="section__block__content">
                            <?= $author->bio; ?>
                        </p><a href="./authorSingle.html" class="section__readMore">Lire plus</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</div>