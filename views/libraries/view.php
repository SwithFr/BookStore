<?php use Helpers\Html; ?>
<?php if($data['library']): ?>
    <div id="content" class="content">
        <div class="section">
            <div class="section__header">
                <h2 class="section__title"><?= $data['library']->name; ?></h2>
                <div class="section__block">
                    <div class="section__block__content">
                        <p><?= $data['library']->tel; ?></p>
                        <p><?= $data['library']->email; ?></p>
                        <p><?= $data['library']->address; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="section__header">
                <h2 class="section__title">Livres présents dans cette bibliothèque</h2>
            </div>
            <?php foreach($data['books'] as $book): ?>
                <div class="section__block book">
                    <img src="<?= $book->img; ?>" class="book__img">
                    <h3 class="section__block__title">
                        <a href="<?= Html::url('view','book',['id'=>$book->id]); ?>"><?= $book->title; ?></a>
                    </h3>
                    <p class="section__block__content">
                        <?= \Helpers\Text::cut($book->summary,200); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>