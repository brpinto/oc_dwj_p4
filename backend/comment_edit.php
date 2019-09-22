<?php ob_start(); ?>
    <header id="page-header">
        <h1>Modifier le commentaire</h1>
    </header>
    <section class="form-container">
        <form action="index.php?action=updateComment&commentId=<?= $comment['id'] ?>&postId=<?= $comment['post_id'] ?>" method="post">
            <input type="text" id="author" name="author" value="<?= $comment['author'] ?>">
            <textarea id="content" name="content" rows="20"><?= $comment['content']?></textarea>
            <div id="button-panel">
                <button type="submit" class="button">Mettre à jour</button>
                <a href="index.php?action=posts_list" class="button">Annuler</a>
                <a href="index.php?action=deleteComment&commentId=<?= $comment['id'] ?>&postId=<?= $comment['post_id'] ?>" class="button">Supprimer le commentaire</a>
            </div>
        </form>
    </section>
<?php $content = ob_get_clean(); ?>
<?php require('template/base.php'); ?>