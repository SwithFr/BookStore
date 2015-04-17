<?php use Helpers\Html; ?>
<div id="content" class="content">
    <div class="section section--dashbord">
        <div class="section__header">
            <h2 class="section__title">
                Bienvenue sur votre Dashboard
                <span class="user__login"><a href="<?= Html::url('edit','user'); ?>" title="Editez vos informations"><?= $data['user']->login; ?></a></span>
            </h2>
        </div>
        <?php if(!$data['hasLibrary']): ?>
            <p class="alert alert--warning">
                Veuillez d'abord créer une bibliothèque pour pouvoir ajouter des livres.
            </p>
            <a class="btn btn--add" href="<?= Html::url('add','librarie'); ?>">Créer une bibliothèque</a>
        <?php else: ?>
            <div class="section__block section__block--library">
                <h3 class="section__block__title section__block__title--library"><?= $data['library']->name; ?></h3>
                <table class="books__list">
                    <thead>
                        <tr>
                            <th>Titre du livre</th>
                            <th>Auteur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['books'] as $book): ?>
                            <tr class="books__list__item">
                                <td><?= $book->title; ?></td>
                                <td><?= $book->first_name . ' ' . $book->last_name; ?></td>
                                <td class="actions">
                                    <a href="<?= Html::url('edit','book',['id'=>$book->id,'library'=>$data['library']->id]); ?>">Edit<i class="icon-pencil"></i></a>
                                    <a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="section__block">
                <a class="btn btn--add" href="<?= Html::url('edit','book',['library'=>$data['library']->id]); ?>">Ajouter un livre</a>
                <a class="btn btn--add" href="<?= Html::url('add','author'); ?>">Ajouter un auteur</a>
                <a class="btn btn--add" href="<?= Html::url('add','editor'); ?>">Ajouter un éditeur</a>
                <a class="btn btn--add" href="<?= Html::url('add','location',['library'=>$data['library']->id]); ?>">Ajouter un emplacement à votre bibliothèque</a>
            </div>
        <?php endif; ?>
    </div>
</div>