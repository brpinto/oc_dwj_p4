<?php ob_start(); ?>

    <header id="page-header">
        <h1>Éditer l'article</h1>
    </header>

    <section class="form-container">
        <form action="index.php?action=updatePost&id=<?= $post['id'] ?>" method="post">
            <input type="text" id='title' name='title' value="<?= htmlspecialchars($post['title']) ?>">
            <textarea id='content' name='content' rows="20"><?= nl2br(htmlspecialchars($post['content'])) ?></textarea>
            <div id="button-panel">
                <button type="submit" class="button">Publier</button>
                <a href="index.php?action=posts_list" class="button">Annuler</a>
                <a href="index.php?action=deletePost&postId=<?= $post['id'] ?>" class="button delete-button">Supprimer l'article</a>
            </div>

        </form>
    </section>

    <section id="comments-container">
        <h2>Commentaires pour cet article</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Commentaire</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Signalement(s)</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Commentaire</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Signalement(s)</th>
                </tr>
            </tfoot>

            <tbody>
            <?php
            while ($comment = $comments->fetch())
            {
                ?>
                <tr>
                    <td class="edit-link"><a href="index.php?action=editComment&commentId=<?= $comment['id'] ?>"><?= $comment['content']. " ..." ?></a></td>
                    <td><?= nl2br(htmlspecialchars($comment['author'])) ?></td>
                    <td><?= $comment['date_fr'] ?></td>
                    <td><?= $comment['down_vote'] ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <a href="./index.php?action=posts_list" class="button">Annuler</a>
    </section>
<?php
    $content = ob_get_clean();
    require('template/base.php');
?>