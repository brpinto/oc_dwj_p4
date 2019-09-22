<?php
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/UserManager.php');

function default_getPosts($offset)
{
	$postManager = new PostManager();
	$posts = $postManager->default_getPosts($offset);
    $count = $postManager->getPostsCount();

    $article_number = $count[0];
	$title = "Billet simple pour l'Alaska | Accueil";

	require ('./view/frontend/posts.php');
}

function default_getPost()
{
	$postManager = new PostManager();
    $commentManager = new CommentManager();

	$post = $postManager->getPost($_GET['postId']);
	$comments = $commentManager->default_getComments($_GET['postId']);
	$title = $post['title'];

	require ('./view/frontend/post.php');
}

function default_addComment($postId, $author, $content)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->addComment($postId, $author, $content);

    if ($affectedLines === false)
    {
        throw new Exception('Impossible d\'ajouter un commentaire');
    }
    else
    {
        header('Location:./index.php?action=showPost&postId='.$postId);
    }
}

function default_downComment($commentId, $postId)
{
    $commentManager = new CommentManager();
    $affectedLine = $commentManager->signalComment($commentId);

    if ($affectedLine === false)
    {
        throw new Exception('Aucun commentaire trouvé');
    }
    else
    {
        header('Location:./index.php?action=showPost&postId='.$postId);
    }
}

function showLogin()
{
    if (isset($_SESSION['user']) && ($_SESSION['user'] === 'admin'))
    {
        header('Location: ./index.php?action=posts_list');
    }
    else
        require('./view/frontend/login.php');
}

function logIn($pseudo, $password)
{
    $userManager = new UserManager();
    $user = $userManager->getUser($pseudo);

    if($pseudo == $user['pseudo'])
    {
        $isPasswordCorrect = password_verify($password, $user['password']);
        if ($isPasswordCorrect)
        {
            session_start();
            $_SESSION['user'] = $pseudo;
            header('Location:./index.php?action=posts_list');
        }
        else
            echo 'AAAAARR';
    }
}

function logOut()
{
    $_SESSION = array();
    session_start();
    session_destroy();
    header('Location: index.php');
}