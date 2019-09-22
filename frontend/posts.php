<?php ob_start(); ?>
	<?php
	while ($post = $posts->fetch())
	{
	?>
		<article class="container">
            <header class="post-header">
                <h2>
                    <a href="index.php?action=showPost&postId=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                </h2>
            </header>
            <section class="post-body">
                <div>
                    <?= nl2br($post['content']) ?>
                </div>
                <span class="read-more">
                    <a href="index.php?action=showPost&postId=<?= $post['id'] ?>">... Lire la suite</a>
                </span>
            </section>
            <footer class="post-footer">
                <span><?= $post['author']. " le " .$post['date'] ?></span>
            </footer>
        </article>
        <div class="container">
            <hr>
        </div>
	<?php
	}
	?>
    <section id="pagination" class="container">
        <?php
        $pages = $article_number / 5;
        $offset = 0;

        for($i = 0; $i < $pages; $i++)
        {
            ?>
            <a class="button" href="index.php?action=showPosts&offset=<?= $offset ?>"><?= ($i + 1) ?></a>
            <?php
            $offset = $offset + 5;
        }
        ?>
    </section>

<?php $content = ob_get_clean(); ?>
<?php require('template/base.php'); ?>
