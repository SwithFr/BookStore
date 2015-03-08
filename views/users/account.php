<div id="content" class="content">
    <div class="section dashbord user">
        <div class="section__header">
            <h2 class="section__title">Dashboard <span class="user__login"><?= $data['user']->login; ?></span></h2>
        </div>
        <?php if(!$data['library']): ?>
            <p class="alert alert--warning">
                Veuillez d'abord créer une bibliothèque pour pouvoir ajouter des livres.
            </p>
            <a class="btn btn--add" href="<?= Html::url('add','library'); ?>">Créer une bibliothèque</a>
        <?php else: ?>
            <div class="section__block">
                <h3 class="section__block__title">Mes livres ajoutés</h3>
                <ul class="books__list">
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                    <li class="books__list__item">Titre du livre
                        <div class="actions"><a href="#">Edit<i class="icon-pencil"></i></a><a href="#" class="admin--delete">Suppr<i class="icon-cancel"></i></a></div>
                    </li>
                </ul>
            </div>
            <div class="section__block">
                <h3 class="section__block__title">Ajouter un livre</h3>
                <form>
                    <input type="text" placeholder="Titre du livre" class="form__addBook__input">
                    <input type="text" placeholder="Année de publication" class="form__addBook__input">
                    <input type="text" placeholder="Genre" class="form__addBook__input">
                    <input type="text" placeholder="Auteur" class="form__addBook__input">
                    <textarea placeholder="Résumé" class="form__addBook__input"></textarea>
                    <input type="file" class="form__addBook__input">
                    <input type="submit" value="Ajouter" class="form__addBook__input">
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>