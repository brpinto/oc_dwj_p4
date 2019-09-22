<?php
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');

function admin_createPost()
{
    $title = "Administration | Écrire un nouvel article";
    require('./view/backend/post_create.php');
}

function admin_newPost($author, $title, $content)
{
	$post = new PostManager();
	$affectedLines = $post->addPost($author, $title, $content);

	if ($affectedLines === false)
	{
		throw new Exception('Impossible d\'ajouter l\'article !');
	}
	else
	{
		header('Location: ./index.php?action=posts_list');
	}
}

function admin_getPosts()
{
	$postManager = new PostManager();
	$posts = $postManager->getPosts();
	$title = "Administration | Articles";

	require ('./view/backend/posts_list.php');
}

function admin_getPost($postId)
{
	$postManager = new PostManager();
	$post = $postManager->getPost($postId);

    $commentManager = new CommentManager();
    $comments = $commentManager->admin_getComments($postId);

    $title = "Administration | Éditer l'article";

	require ('./view/backend/post_edit.php');
}

function admin_editPost($postId, $title, $content)
{
	$postManager = new PostManager();
	$posts = $postManager->updatePost($postId, $title, $content);

	if ($affectedLines === false)
	{
		throw new Exception('Impossible de modifier l\'article !');
	}
	else
	{
		header('Location: ./index.php?action=posts_list');
	}
}

function admin_deletePost($postId)
{
    $postManager = new PostManager();
    $post = $postManager->deletePost($postId);

    if ($affectedLine === false)
    {
        throw new Exception('Aucun id renseigné');
    }
    else
    {
        header('Location: ./index.php?action=posts_list');
    }
}

function admin_getCommentsList()
{
    $commentManager = new CommentManager();
    $comments = $commentManager->admin_getCommentsList();

    $title = "Administration | Commentaires";
    require ('./view/backend/comments_list.php');
}

function admin_getComment($commentId)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->admin_getComment($commentId);

    $title = "Administration | Éditer le commentaire";
    require ('./view/backend/comment_edit.php');
}

function admin_updateComment($postId, $commentId, $content, $author)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->admin_updateComment($commentId, $author, $content);

    if ($affectedLine === false)
    {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else
    {
        header('Location: ./index.php?action=editPost&id=' .$postId);
    }
}

function admin_deleteComment($postId, $commentId)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->admin_deleteComment($commentId);

    if ($affectedLine === false)
    {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else
    {
        header('Location: ./index.php?action=editPost&id=' .$postId);
    }
}
?>