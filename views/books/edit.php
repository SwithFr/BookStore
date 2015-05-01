<?php use Helpers\Html; ?>
<div class="section">

    <?php if(isset($_GET['id'])): ?>
        <h2 class="section__title">Modifier un livre</h2>
        <form class="form--add"
              action="<?= Html::url('edit', 'book',['library'=>$data['library_id'],'id'=>$_GET['id']]); ?>"
              method="post"
              enctype="multipart/form-data">
    <?php else: ?>
        <h2 class="section__title">Ajouter un livre</h2>
        <form class="form--add"
              action="<?= Html::url('edit', 'book',['library'=>$data['library_id']]); ?>"
              method="post"
              enctype="multipart/form-data">
    <?php endif; ?>

        <label class="form__label" for="title">Titre du livre</label>
        <?= isset($data['errors']['title']) ? '<span class="has-error">' . $data['errors']['title'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="title"
               id="title"
               value="<?= isset($data['d']['title']) ? $data['d']['title'] : ''; ?>"/>

        <label class="form__label" for="img">Image de couverture</label>
        <?= isset($data['errors']['img']) ? '<span class="has-error">' . $data['errors']['img'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="file"
               name="img"
               id="img"/>

        <label class="form__label" for="summary">Résumé</label>
        <?= isset($data['errors']['summary']) ? '<span class="has-error">' . $data['errors']['summary'] . '</span>' : ''; ?></span>
        <textarea class="form__textarea"
                  name="summary"
                  id="summary"><?= isset($data['d']['summary']) ? $data['d']['summary'] : ''; ?></textarea>

        <label class="form__label" for="isbn">Numéro ISBN</label>
        <?= isset($data['errors']['isbn']) ? '<span class="has-error">' . $data['errors']['isbn'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="isbn"
               id="isbn"
               value="<?= isset($data['d']['isbn']) ? $data['d']['isbn'] : ''; ?>"/>

        <label class="form__label" for="nbpages">Nombre de pages</label>
        <?= isset($data['errors']['nbpages']) ? '<span class="has-error">' . $data['errors']['nbpages'] . '</span>' : ''; ?></span>
        <input class="form__input form__input--large"
               type="text"
               name="nbpages"
               id="nbpages"
               value="<?= isset($data['d']['nbpages']) ? $data['d']['nbpages'] : ''; ?>"/>

        <label class="form__label" for="author_id">Selectionnez l'auteur</label>
        <select class="form__input"
                name="author_id"
                id="author_id">
            <?php foreach ($data['authors'] as $author): ?>
                <option <?= (isset($data['d']['author_id']) && $data['d']['author_id'] == $author->id) ? 'selected="selected"' : '' ?>
                    value="<?= $author->id; ?>"><?= $author->first_name . ' ' . $author->last_name; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form__label" for="genre_id">Selectionnez le genre</label>
        <select class="form__input"
                name="genre_id"
                id="genre_id">
            <?php foreach ($data['genres'] as $genre): ?>
                <option <?= (isset($data['d']['genre_id']) && $data['d']['genre_id'] == $genre->id) ? 'selected="selected"' : '' ?>
                    value="<?= $genre->id; ?>"><?= $genre->name; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form__label" for="language_id">Selectionnez la langue</label>
        <select class="form__input"
                name="language_id"
                id="language_id">
            <?php foreach ($data['languages'] as $language): ?>
                <option <?= (isset($data['d']['language_id']) && $data['d']['language_id'] == $language->id) ? 'selected="selected"' : ''; ?>
                    value="<?= $language->id; ?>"><?= $language->name; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form__label" for="editor_id">Selectionnez l'éditeur </label>
        <select class="form__input"
                name="editor_id"
                id="editor_id">
            <?php foreach ($data['editors'] as $editor): ?>
                <option <?= (isset($data['d']['editor_id']) && $data['d']['editor_id'] == $editor->id) ? 'selected="selected"' : '' ?>
                    value="<?= $editor->id; ?>"><?= $editor->name; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form__label" for="location_id">Selectionnez l'emplacement</label>
        <select class="form__input"
                name="location_id"
                id="location_id">
            <?php foreach ($data['locations'] as $location): ?>
                <option <?= (isset($data['d']['location_id']) && $data['d']['location_id'] == $location->id) ? 'selected="selected"' : '' ?>
                    value="<?= $location->id; ?>"><?= $location->name; ?></option>
            <?php endforeach; ?>
        </select>

        <?php if(isset($_GET['id'])): ?>
            <input class="form__submit btn btn--send"
                   type="submit"
                   value="Modifier ce livre"/>
        <?php else: ?>
            <input class="form__submit btn btn--send"
                   type="submit"
                   value="Ajouter ce livre"/>
        <?php endif; ?>
    </form>
</div>