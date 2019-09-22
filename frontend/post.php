<?php ob_start(); ?>
    <article class="container post-container">
        <header class="post-header">
            <h2><?= $post['title'] ?></h2>
        </header>
        <section class="post-body">
            <div>
                <?= nl2br($post['content']) ?>
            </div>
        </section>
        <footer class="post-footer">
            <span><?= $post['author']. " le " .$post['date'] ?></span>
        </footer>
    </article>

    <div class="container">
        <hr>
    </div>

	<section class="container">
		<!--<section>
			<h4><?= $post['author'] ?></h4>
			<p>
				<span><a href="#">Twitter</a></span>
				<span><a href="#">Facebook</a></span>
			</p>
			<div>
				<p>Description de l'auteur</p>
			</div>
		</section>-->
		<section class="comments-container">
		    <h4>Commentaires</h4>
            <div>
                <form action="index.php?action=addComment&postId=<?= $post['id'] ?>" method="post">
                    <p><label for="content">Ajouter un commentaire</label></p>
                    <p><input type="text" id="author" name="author" placeholder="Votre pseudo"></p>
                    <p><textarea id="content" name="content" placeholder="Votre commentaire" cols="60" rows="7"></textarea></p>
                    <button>Commenter</button>
                </form>
            </div>
            <div class="container">
                <hr>
            </div>
            <?php
            while ($comment = $comments->fetch())
            {
            ?>
            <section class="single-comment-container">
                <header class="comment-header">
                    <div class="comment-title">
                        <span class="comment-author"><?= $comment['author'] ?></span>
                        <span class="comment-date">Le <?= $comment['date_fr'] ?></span>
                    </div>
                    <span>
                        <a href="index.php?action=downVote&id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>">
                            <img src="./././static/images/down_vote.png" alt="pouce vers le bas, signaler" title="Signaler">
                        </a>
                    </span>
                </header>
                <div class="comment-body">
                    <?= $comment['content'] ?>
                </div>
            </section>
            <?php
            }
            ?>
		</section>
	</section>
<?php $content = ob_get_clean(); ?>
<?php require('template/base.php'); ?>
