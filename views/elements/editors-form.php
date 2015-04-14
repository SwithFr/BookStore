<form action="<?= \Helpers\Html::url('search','editor'); ?>" class="form" method="post">
    <input placeholder="Chercher un editeur..."
           class="form__input form--search"
           name="search"
           id="search">
    <input type="submit" class="form__submit form--search--submit">
</form>