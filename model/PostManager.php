<?php
require_once ('Manager.php');

class PostManager extends Manager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
		$posts = $db->query('SELECT id, author, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS date FROM posts ORDER BY date DESC LIMIT 5');

		return $posts;
	}

    public function default_getPosts($offset)
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, author, title, SUBSTRING(content, 1, 200) AS content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS date FROM posts ORDER BY date DESC LIMIT 5 OFFSET ' .$offset);

        return $posts;
    }

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, author, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS date FROM posts WHERE id = ?');
		$req->execute(array($postId));

		$post = $req->fetch();

		return $post;
	}

	public function addPost($author, $title, $content)
	{
		$db = $this->dbConnect();
		$post = $db->prepare('INSERT INTO posts(author, title, content, creation_date, update_date) VALUES(:author, :title, :content, NOW(), NOW())');
		$affectedLines = $post->execute(array(
			'author' => $author,
			'title' => $title,
			'content' => $content));

		return $affectedLines;
	}

	public function updatePost($postId, $title, $content)
	{
		$db = $this->dbConnect();
		$post = $db->prepare('UPDATE posts SET title = :title, content = :content, update_date = NOW() WHERE id = :id');
		$affectedLines = $post->execute(array(
			'title' => $title,
			'content' => $content,
			'id' => $postId));

		return $affectedLines;
	}

	public function deletePost($postId)
	{
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLine = $req->execute(array($postId));

        return $affectedLine;
	}

    public function getPostsCount()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) FROM posts');
        $count = $req->fetch();

        return $count;
    }
}
