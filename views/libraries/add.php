<div class="section">
    <h2 class="section__title">Créer une bibliothèque</h2>

    <form class="form--add" action="<?= Html::url('add', 'librarie'); ?>" method="post">
        <label class="form__label" for="name">Nom de votre bibliothèque</label>
        <?= isset($data['errors']['name']) ? '<span class="has-error">' . $data['errors']['name'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="name" id="name"
               value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"/>

        <label class="form__label" for="address">Adresse complète</label>
        <?= isset($data['errors']['address']) ? '<span class="has-error">' . $data['errors']['address'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="address" id="address"
               value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>"/>

        <label class="form__label" for="tel">Numéro de téléphone</label>
        <?= isset($data['errors']['tel']) ? '<span class="has-error">' . $data['errors']['tel'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="tel" id="tel"
               value="<?= isset($_POST['tel']) ? $_POST['tel'] : ''; ?>"/>

        <label class="form__label" for="email">Email de contact</label>
        <?= isset($data['errors']['email']) ? '<span class="has-error">' . $data['errors']['email'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="email" name="email" id="email"
               value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"/>

        <label class="form__label" for="private">Cette bibliothèque est privée (non visible aux utilisateurs)</label>
        <input class="form__input form__input--large" type="checkbox" name="private" id="private"/>

        <input class="form__submit btn btn--send" type="submit" value="Créer cette bibliothèque"/>
    </form>
</div>