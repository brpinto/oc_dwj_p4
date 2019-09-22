<?php
require_once('Manager.php');

class CommentManager extends Manager
{
    public function default_getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM comments WHERE post_id = ? ORDER BY date_fr');
        $comments->execute(array($postId));

        return $comments;
    }

    public function admin_getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, SUBSTR(content, 1, 20) AS content, down_vote, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM comments WHERE post_id = ? ORDER BY down_vote DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function admin_getCommentsList()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT id, author, SUBSTR(content, 1, 20) AS content, down_vote, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM comments ORDER BY down_vote DESC');

        return $comments;
    }

    public function admin_getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));

        $comment = $req->fetch();
        return $comment;
    }

    public function admin_updateComment($commentId, $content, $author)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('UPDATE comments SET author = :author, content = :content, update_date = NOW() WHERE id = :id');
        $affectedLine = $post->execute(array(
            'author' => $author,
            'content' => $content,
            'id' => $commentId));

        return $affectedLine;
    }

    public function admin_deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLine = $req->execute(array($commentId));

        return $affectedLine;
    }

    public function addComment($postId, $author, $content)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('INSERT INTO comments(post_id, author, content, creation_date, update_date,
              down_vote) VALUES(?, ?, ?, NOW(), NOW(), 0)');
		$affectedLines = $comment->execute(array($postId, $author, $content));

		return $affectedLines;
	}

	public function signalComment($commentId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET down_vote = down_vote + 1 WHERE id = ?');
		$affectedLine = $req->execute(array($commentId));

		return $affectedLine;
	}
}
