<?php use Helpers\Html; ?>
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
            <h3 class="section__block__title--library"><?= $data['library']->name; ?></h3>
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
                                <a href="<?= Html::url('delete','book',['id'=>$book->id]); ?>" class="admin--delete">Suppr<i class="icon-cancel"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="section__block">
            <a class="btn btn--add btn--inline" href="<?= Html::url('edit','book',['library'=>$data['library']->id]); ?>">Ajouter un livre</a>
            <a class="btn btn--add btn--inline" href="<?= Html::url('add','author'); ?>">Ajouter un auteur</a>
            <a class="btn btn--add btn--inline" href="<?= Html::url('add','editor'); ?>">Ajouter un éditeur</a>
            <a class="btn btn--add btn--inline" href="<?= Html::url('add','location',['library'=>$data['library']->id]); ?>">Ajouter un emplacement à votre bibliothèque</a>
        </div>
    <?php endif; ?>
    <?php if(!$data['authors']): ?>
        <p class="alert alert--warning clearfix">
            Vous n'avez pas encore ajouté d'auteur
        </p>
        <a class="btn btn--add btn--inline" href="<?= Html::url('add','author'); ?>">Ajouter un auteur</a>
    <?php else: ?>
        <div class="section__block section__block--library clearfix">
            <h3 class="section__block__title--library">Auteurs que vous avez ajouté</h3>
            <table class="books__list">
                <thead>
                <tr>
                    <th>Prénom Nom</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['authors'] as $author): ?>
                    <tr class="books__list__item">
                        <td><?= $author->first_name . ' ' .$author->last_name; ?></td></td>
                        <td class="actions">
                            <a href="<?= Html::url('edit','author',['id'=>$author->id]); ?>">Edit<i class="icon-pencil"></i></a>
                            <?php if(!$author->hasBooks): ?>
                                <a href="<?= Html::url('delete','author',['id'=>$author->id]); ?>" class="admin--delete">Suppr<i class="icon-cancel"></i></a>
                            <?php else: ?>
                                <p class="section__block__infos">Cet auteur est lié à des livres</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= Html::paginate($data['nbPages'],'index','user'); ?>
        </div>
    <?php endif; ?>
</div>
