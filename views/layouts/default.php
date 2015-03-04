<?php require(D_VIEWS . DS . 'elements' . DS . 'header.php'); ?>

<?php require(D_VIEWS . DS . 'elements' . DS . 'nav.php'); ?>

<div id="content" class="content">
    <?php require(D_VIEWS . DS . 'elements' . DS . 'main-form.php'); ?>

    <?php include(D_VIEWS . DS . $controller->view); ?>
</div>

<?php require(D_VIEWS . DS . 'elements' . DS . 'footer.php'); ?>
