<?php ob_start(); ?>
    <header id="page-header">
        <h1>Commentaires</h1>
    </header>
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
<?php
    $content = ob_get_clean();
    require('template/base.php');
?>