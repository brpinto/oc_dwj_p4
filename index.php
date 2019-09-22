<?php session_start(); ?>
<?php
require_once ('controller/backend.php');
require_once ('controller/frontend.php');

try
{
    if(isset($_GET['action']))
	{
		if ($_GET['action'] == 'addPost')
		{
			if(!empty($_POST['title']) && !empty($_POST['content']))
			{
				admin_newPost('brounch', $_POST['title'], $_POST['content']);
			}
			else
			{
				throw new Exception('Il manque un titre ou un contenu à cet article');
			}
		}
		elseif ($_GET['action'] == "posts_list")
		{
            admin_getPosts();
		}
        elseif ($_GET['action'] == "createPost")
        {
                admin_createPost();
        }
		elseif ($_GET['action'] == "editPost")
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				admin_getPost($_GET['id']);
			}
			else
			{
				throw new Exception ('Aucun article n\'a été trouvé');
			}
		}
		elseif ($_GET['action'] == "updatePost")
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				if(!empty($_POST['title']) && !empty($_POST['content']))
				{
					admin_editPost($_GET['id'], $_POST['title'], $_POST['content']);
				}
				else
				{
					throw new Exception('Impossible de mettre à jour l\'article');
				}
			}
		}
        elseif ($_GET['action'] == "showPosts")
        {
            if (isset($_GET['offset']) && $_GET['offset'] >= 0)
            {
                default_getPosts($_GET['offset']);
            }
            else
            {
                throw new Exception ('Aucun article n\'a été trouvé');
            }
        }
		elseif ($_GET['action'] == "showPost")
		{
			if (isset($_GET['postId']) && $_GET['postId'] > 0)
			{
				default_getPost($_GET['postId']);
			}
			else
			{
				throw new Exception ('Aucun article n\'a été trouvé');
			}
		}
        elseif ($_GET['action'] == "deletePost")
        {
            if (isset($_GET['postId']) && $_GET['postId'] > 0)
            {
                admin_deletePost($_GET['postId']);
            }
            else
            {
                throw new Exception ('Aucun id trouvé');
            }
        }
        elseif ($_GET['action'] == "addComment")
        {
            if (isset($_GET['postId']) && $_GET['postId'] > 0)
            {
                if (!empty($_POST['content']))
                    default_addComment($_GET['postId'], $_POST['author'], $_POST['content']);
                else
                    throw new Exception('Impossible d\'ajouter le commentaire');
            }
            else
            {
                throw new Exception ('Aucun article n\'a été trouvé');
            }
        }
        elseif ($_GET['action'] == "editComment")
        {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0)
            {
                admin_getComment($_GET['commentId']);
            }
            else
            {
                throw new Exception ('Aucun commentaire n\'a été trouvé');
            }
        }
        elseif ($_GET['action'] == "updateComment")
        {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0)
            {
                if (isset($_GET['postId']) && $_GET['postId'] > 0)
                {
                    if (!empty($_POST['author']) && !empty($_POST['content']))
                        admin_updateComment($_GET['postId'], $_GET['commentId'], $_POST['author'], $_POST['content']);
                }
            }
            else
            {
                throw new Exception ('Aucun commentaire n\'a été trouvé');
            }
        }
        elseif ($_GET['action'] == "downVote")
        {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0)
            {
                    default_downComment($_GET['id'], $_GET['postId']);
            }
            else
            {
                throw new Exception ('Aucun article n\'a été trouvé');
            }
        }
        elseif ($_GET['action'] == "deleteComment")
        {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0)
            {
                if (isset($_GET['postId']) && $_GET['postId'] > 0)
                {
                    admin_deleteComment($_GET['postId'], $_GET['commentId']);
                }
            }
            else
            {
                throw new Exception ('Aucun id trouvé');
            }
        }
        elseif ($_GET['action'] == "admin")
        {
            showLogin();
        }
        elseif ($_GET['action'] == "logIn")
        {
            if(!empty($_POST['pseudo']) && !empty($_POST['mdp']))
                logIn($_POST['pseudo'], $_POST['mdp']);
            else
                throw new Exception('Le pseudo ou le mot de passe est incorrect ');
        }
        elseif ($_GET['action'] == "logOut")
        {
            logOut();
        }
        elseif ($_GET['action'] == "comments_list")
        {
            admin_getCommentsList();
        }
	}
	else
	{
		default_getPosts(0);
	}
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    // require('view/errorView.php');
}
?>