<?php
use Helpers\Html;
use Components\Session;

?>
<div class="section">
    <p class="ariane"><a href="<?= Html::url('index', 'user'); ?>">Retour</a></p>
    <div class="section__block section__block--library">
        <h3 class="section__block__title--library">Votre liste de lecture</h3>
        <table class="books__list">
            <thead>
            <tr>
                <th>Titre du livre</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['readLaterBooks'] as $book): ?>
                <tr class="books__list__item" id="<?= $book->id; ?>">
                    <td><?= $book->title; ?></td>
                    <td class="actions">
                        <a href="<?= $book->link(); ?>">Voir le livre</a>
                        |
                        <a class="admin--delete removeReadLaterLinkFromList"
                           data-book_id="<?= $book->id; ?>" data-user_id="<?= Session::getId(); ?>"
                           href="<?= Html::url('removeToReadLater', 'book'); ?>">Retirer de la liste</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>