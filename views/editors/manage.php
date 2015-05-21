<?php use Helpers\Html; ?>
<div class="section">
    <p class="ariane"><a href="<?= Html::url('manage', 'librarie'); ?>">Retour</a></p>
    <?php if (!$data['editors']): ?>
        <p class="alert alert--warning clearfix">
            Vous n'avez pas encore ajouté d'éditeur
        </p>
        <a class="btn btn--add btn--inline" href="<?= Html::url('add', 'author'); ?>">Ajouter un auteur</a>
    <?php else: ?>
        <a class="btn btn--add btn--inline" href="<?= Html::url('add', 'author'); ?>">Ajouter un auteur</a>
        <div class="section__block section__block--library clearfix">
            <h3 class="section__block__title--library">Auteurs que vous avez ajoutés</h3>
            <table class="books__list">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['editors'] as $editor): ?>
                    <tr class="books__list__item">
                        <td><?= $editor->name; ?></td>
                        <td><?= $editor->website; ?></td>
                        <td class="actions">
                            <a href="<?= Html::url('edit', 'editor', ['id'=>$editor->id]); ?>">Edit<i
                                    class="icon-pencil"></i></a>
                            <?php if (!$editor->hasBooks): ?>
                                <a href="<?= Html::url('delete', 'editor', ['id' => $editor->id]); ?>"
                                   class="admin--delete">Suppr<i class="icon-cancel"></i></a>
                            <?php else: ?>
                                <p class="section__block__infos">Cet éditeur est lié à des livres</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= Html::paginate($data['nbPages'], 'manage', 'editor'); ?>
        </div>
    <?php endif; ?>
</div>