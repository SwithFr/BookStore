<?php use Helpers\Html; ?>
<div class="section">
    <p class="ariane"><a href="<?= Html::url('manage', 'librarie'); ?>">Retour</a></p>
    <h2 class="section__title">Editer vos informations</h2>

    <form class="form--add" action="<?= Html::url('edit', 'librarie',['library'=>$data['library']->id]); ?>" method="post">
        <label class="form__label" for="name">Nom de votre bibliothèque</label>
        <?= isset($data['errors']['name']) ? '<span class="has-error">' . $data['errors']['name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="name" id="name"
               value="<?= isset($data['library']->name) ? $data['library']->name : ''; ?>"/>

        <label class="form__label" for="address">Adresse complète</label>
        <?= isset($data['errors']['address']) ? '<span class="has-error">' . $data['errors']['address'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="address" id="address"
               value="<?= isset($data['library']->address) ? $data['library']->address : ''; ?>"/>

        <label class="form__label" for="tel">Numéro de téléphone</label>
        <?= isset($data['errors']['tel']) ? '<span class="has-error">' . $data['errors']['tel'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="tel" id="tel"
               value="<?= isset($data['library']->tel) ? $data['library']->tel : ''; ?>"/>

        <label class="form__label" for="email">Email de contact</label>
        <?= isset($data['errors']['email']) ? '<span class="has-error">' . $data['errors']['email'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="email" name="email" id="email"
               value="<?= isset($data['library']->email) ? $data['library']->email : ''; ?>"/>

        <label class="form__label" for="private">Cette bibliothèque est privée (non visible aux utilisateurs)</label>
        <input class="form__input form__input--large" <?= $data['library']->private == 1 ? 'checked' : ''; ?> type="checkbox" name="private" id="private"/>

        <input class="form__submit btn btn--send" type="submit" value="Editer cette bibliothèque"/>
    </form>
    <?php if (!$data['locations']): ?>
        <p class="alert alert--warning clearfix">
            Vous n'avez pas encore ajouté d'emplacement à cette bibliothèque
        </p>
    <?php else: ?>
        <a class="btn btn--add btn--inline" href="<?= Html::url('add', 'location', ['library'=>$data['library']->id]); ?>">Ajouter un emplacement</a>
        <div class="section__block section__block--library clearfix">
            <h3 class="section__block__title--library">Vos emplacements</h3>
            <table class="books__list">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['locations'] as $location): ?>
                    <tr class="books__list__item">
                        <td><?= $location->name; ?></td>
                        </td>
                        <td class="actions">
                            <a href="<?= Html::url('edit', 'location', ['id' => $location->id]); ?>">Edit<i
                                    class="icon-pencil"></i></a>
                            <?php if (!$location->hasBooks): ?>
                                <a href="<?= Html::url('delete', 'location', ['id' => $location->id,'library'=>$data['library']->id]); ?>"
                                   class="admin--delete">Suppr<i class="icon-cancel"></i></a>
                            <?php else: ?>
                                <p class="section__block__infos">Cet emplacement est lié à des livres</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>