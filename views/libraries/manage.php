<?php use Helpers\Html; ?>
<div class="alert alert--warning">
    Attention avant d'ajouter un livre, assurez-vous que l'auteur, l'éditeur... éxistent déjà, sinon ajoutez les avant !
</div>
<div class="btn__group">
    <a class="btn btn--add btn--inline" href="<?= Html::url('edit','book',['library'=>$data['library']->id]); ?>">Ajouter un livre</a>
    <a class="btn btn--add btn--inline" href="<?= Html::url('add','author'); ?>">Ajouter un auteur</a>
    <a class="btn btn--add btn--inline" href="<?= Html::url('add','editor'); ?>">Ajouter un éditeur</a>
    <?php if(!$data['hasLocation']): ?>
        <a class="btn alert alert--warning" href="<?= Html::url('add','editor'); ?>">Vous n'avez pas encore ajouté d'emplacement, ajoutez en un !</a>
    <?php else: ?>
        <a class="btn btn--add btn--inline" href="<?= Html::url('add','location',['library'=>$data['library']->id]); ?>">Ajouter un emplacement</a>
    <?php endif; ?>
</div>
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
    <?= Html::paginate($data['nbPages'],'manage','librarie'); ?>
</div>