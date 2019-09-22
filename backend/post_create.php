<?php ob_start(); ?>
<header id="page-header">
    <h1>Ajouter un nouvel article</h1>
</header>
<section class="form-container">
    <form action="index.php?action=addPost" method="post">
        <input type="text" id='title' name='title' placeholder="Saisissez votre titre ici">
        <textarea id='content' name='content' rows="20"></textarea>
        <div id="button-panel">
            <button type="submit" class="button">Publier</button>
            <a href="index.php?action=posts_list" class="button">Annuler</a>
        </div>
    </form>
</section>
<?php
    $content = ob_get_clean();
    require('template/base.php');
?>
