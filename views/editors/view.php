<?php use Helpers\Html; ?>
<?php if($data['editor']): ?>
    <div id="content" class="content">
        <div class="section">
            <div class="section__header">
                <h2 class="section__title"><?= $data['editor']->name; ?></h2>
                <div class="section__block bio">
                    <div class="section__block__content">
                        <?= $data['editor']->history; ?>
                    </div>
                </div>
                <div class="section__block infos">
                    <img src="./assets/img/<?= $data['editor']->img; ?>" class="section__block__img">
                    <?php if(!empty($data['books'])): ?>
                        <h3>Livres édité :</h3>
                        <ul id="books__list">
                            <?php foreach($data['books'] as $book): ?>
                                <li>
                                    <a href="<?= Html::url('view','book',['id'=>$book->id]); ?>"><?= $book->title; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>