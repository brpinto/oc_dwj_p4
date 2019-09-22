<?php ob_start(); ?>
    <!--<header class="page-header">
        <h1>Articles</h1>
        <div class="button">
            <a href="./index.php?action=createPost">Ajouter</a>
        </div>
    </header>

	<table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date</th>
            </tr>
        </tfoot>

        <tbody>

        </tbody>
	</table>-->
    <header id="page-header">
        <h1>Articles</h1>
        <a href="./index.php?action=createPost" class="button">Ajouter</a>
    </header>

    <table class="table">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
        </tr>
        </tfoot>

        <tbody>
        <?php
        while ($post = $posts->fetch())
        {
            ?>
            <tr>
                <td class="edit-link"><a href="index.php?action=editPost&id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></td>
                <td><?= $post['author'] ?></td>
                <td><?= $post['date'] ?></td>
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
