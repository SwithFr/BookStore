<div class="section">
    <h2 class="section__title">Ajouter un livre</h2>

    <form class="form--add" action="<?= Html::url('add', 'book'); ?>" method="post">
        <label class="form__label" for="title">Titre du livre</label>
        <?= isset($data['errors']['title']) ? '<span class="has-error">' . $data['errors']['title'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="title" id="title"
               value="<?= isset($_POST['title']) ? $_POST['title'] : ''; ?>"/>

        <label class="form__label" for="summary">Résumé</label>
        <?= isset($data['errors']['summary']) ? '<span class="has-error">' . $data['errors']['summary'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="summary" id="summary"
               value="<?= isset($_POST['summary']) ? $_POST['summary'] : ''; ?>"/>

        <label class="form__label" for="isbn">Numéro ISBN</label>
        <?= isset($data['errors']['isbn']) ? '<span class="has-error">' . $data['errors']['isbn'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="isbn" id="isbn"
               value="<?= isset($_POST['isbn']) ? $_POST['isbn'] : ''; ?>"/>

        <label class="form__label" for="nbpages">Nombre de pages</label>
        <?= isset($data['errors']['nbpages']) ? '<span class="has-error">' . $data['errors']['nbpages'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large" type="text" name="nbpages" id="nbpages"
               value="<?= isset($_POST['nbpages']) ? $_POST['nbpages'] : ''; ?>"/>

        <label class="form__label" for="genre_id">Selectionnez le genre</label>
        <select class="form__input" name="genre_id" id="genre_id">
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
        </select>

        <label class="form__label" for="language_id">Selectionnez la langue</label>
        <select class="form__input" name="language_id" id="language_id">
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
        </select>

        <label class="form__label" for="editor_id">Selectionnez l'éditeur</label>
        <select class="form__input" name="editor_id" id="editor_id">
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
        </select>

        <label class="form__label" for="location_id">Selectionnez l'emplacement</label>
        <select class="form__input" name="location_id" id="location_id">
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
            <option value="1">test</option>
        </select>

        <input class="form__submit btn btn--send" type="submit" value="Ajouter ce livre"/>
    </form>

    <a class="btn btn--add btn--inline btn--small" href="<?= Html::url('add','author'); ?>">Ajouter un auteur</a>
    <a class="btn btn--add btn--inline btn--small" href="<?= Html::url('add','editor'); ?>">Ajouter un éditeur</a>
    <a class="btn btn--add btn--inline btn--small" href="<?= Html::url('add','location'); ?>">Ajouter un emplacement</a>
</div>