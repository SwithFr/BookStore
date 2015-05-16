<form action="<?= \Helpers\Html::url('searchAll', 'page'); ?>" class="form" method="post">
    <input placeholder="Chercher un livre, un auteur..."
           class="form__input form--search"
           name="search"
           id="search">
    <input type="submit" class="form__submit form--search--submit">
</form>