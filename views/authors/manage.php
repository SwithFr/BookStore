<?php use Helpers\Html; ?>
    <p class="ariane"><a href="<?= Html::url('index', 'user'); ?>">Retour</a></p>
<?php if (!$data['authors']): ?>
    <p class="alert alert--warning clearfix">
        Vous n'avez pas encore ajouté d'auteur
    </p>
    <a class="btn btn--add btn--inline" href="<?= Html::url('add', 'author'); ?>">Ajouter un auteur</a>
<?php else: ?>
    <a class="btn btn--add btn--inline" href="<?= Html::url('add', 'author'); ?>">Ajouter un auteur</a>
    <div class="section__block section__block--library clearfix">
        <h3 class="section__block__title--library">Auteurs que vous avez ajoutés</h3>
        <table class="books__list">
            <thead>
            <tr>
                <th>Prénom Nom</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['authors'] as $author): ?>
                <tr class="books__list__item">
                    <td><?= $author->first_name . ' ' . $author->last_name; ?></td>
                    </td>
                    <td class="actions">
                        <a href="<?= Html::url('edit', 'author', ['id' => $author->id]); ?>">Edit<i
                                class="icon-pencil"></i></a>
                        <?php if (!$author->hasBooks): ?>
                            <a href="<?= Html::url('delete', 'author', ['id' => $author->id]); ?>"
                               class="admin--delete">Suppr<i class="icon-cancel"></i></a>
                        <?php else: ?>
                            <p class="section__block__infos">Cet auteur est lié à des livres</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?= Html::paginate($data['nbPages'], 'manage', 'author'); ?>
    </div>
<?php endif; ?>