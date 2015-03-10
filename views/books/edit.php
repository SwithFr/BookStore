<?php use Helpers\Html; ?>
<div class="section">
    <h2 class="section__title">Editer un livre</h2>

    <form class="form--add" action="<?= Html::url('edit', 'book'); ?>&library=<?= $data['library_id']; ?>" method="post" enctype="multipart/form-data">
        <label class="form__label" for="title">Titre du livre</label>
        <?= isset($data['errors']['title']) ? '<span class="has-error">' . $data['errors']['title'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="title"
               id="title"
               value="<?= isset($_POST['title']) ? $_POST['title'] : ''; ?>"/>

        <label class="form__label" for="img">Image de couverture</label>
        <?= isset($data['errors']['img']) ? '<span class="has-error">' . $data['errors']['img'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="file"
               name="img"
               id="img"
               value="<?= isset($_POST['img']) ? $_POST['img'] : ''; ?>"/>

        <label class="form__label" for="summary">Résumé</label>
        <?= isset($data['errors']['summary']) ? '<span class="has-error">' . $data['errors']['summary'] . '</span>' : ''; ?></span>
        <textarea class="form__textarea"
                  name="summary"
                  id="summary"><?= isset($_POST['summary']) ? $_POST['summary'] : ''; ?></textarea>

        <label class="form__label" for="isbn">Numéro ISBN</label>
        <?= isset($data['errors']['isbn']) ? '<span class="has-error">' . $data['errors']['isbn'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="isbn"
               id="isbn"
               value="<?= isset($_POST['isbn']) ? $_POST['isbn'] : ''; ?>"/>

        <label class="form__label" for="nbpages">Nombre de pages</label>
        <?= isset($data['errors']['nbpages']) ? '<span class="has-error">' . $data['errors']['nbpages'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="nbpages"
               id="nbpages"
               value="<?= isset($_POST['nbpages']) ? $_POST['nbpages'] : ''; ?>"/>

        <label class="form__label" for="author_id">Selectionnez l'auteur</label>
        <select class="form__input"
                name="author_id"
                id="author_id">
            <?php foreach ($data['authors'] as $author): ?>
                <option <?= (isset($_POST['author_id']) && $_POST['author_id'] == $author->id) ? 'selected="selected"' : '' ?>
                    value="<?= $author->id; ?>"><?= $author->first_name . ' ' . $author->last_name; ?></option>
            <?php endforeach; ?>
        </select>
        <a class="btn btn--add btn--inline btn--small" href="<?= Html::url('add', 'author'); ?>">Ajouter un auteur</a>

        <label class="form__label" for="genre_id">Selectionnez le genre</label>
        <select class="form__input"
                name="genre_id"
                id="genre_id">
            <?php foreach ($data['genres'] as $genre): ?>
                <option <?= (isset($_POST['genre_id']) && $_POST['genre_id'] == $genre->id) ? 'selected="selected"' : '' ?>
                    value="<?= $genre->id; ?>"><?= $genre->name; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form__label" for="language_id">Selectionnez la langue</label>
        <select class="form__input"
                name="language_id"
                id="language_id">
            <?php foreach ($data['languages'] as $language): ?>
                <option <?= (isset($_POST['language_id']) && $_POST['language_id'] == $language->id) ? 'selected="selected"' : ''; ?>
                    value="<?= $language->id; ?>"><?= $language->name; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form__label" for="editor_id">Selectionnez l'éditeur </label>
        <select class="form__input"
                name="editor_id"
                id="editor_id">
            <?php foreach ($data['editors'] as $editor): ?>
                <option <?= (isset($_POST['editor_id']) && $_POST['editor_id'] == $editor->id) ? 'selected="selected"' : '' ?>
                    value="<?= $editor->id; ?>"><?= $editor->name; ?></option>
            <?php endforeach; ?>
        </select>
        <a class="btn btn--add btn--inline btn--small" href="<?= Html::url('add', 'editor'); ?>">Ajouter un éditeur</a>

        <label class="form__label" for="location_id">Selectionnez l'emplacement</label>
        <select class="form__input"
                name="location_id"
                id="location_id">
            <?php foreach ($data['locations'] as $location): ?>
                <option <?= (isset($_POST['location_id']) && $_POST['location_id'] == $location->id) ? 'selected="selected"' : '' ?>
                    value="<?= $location->id; ?>"><?= $location->name; ?></option>
            <?php endforeach; ?>
        </select>
        <a class="btn btn--add btn--inline btn--small" href="<?= Html::url('add', 'location'); ?>&library=<?= $data['library_id']; ?>">Ajouter un emplacement</a>

        <input class="form__submit btn btn--send"
               type="submit"
               value="Ajouter ce livre"/>
    </form>
</div>