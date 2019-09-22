<?php
class Manager
{
	protected function dbConnect()
	{
		$db = new PDO('mysql:host=brunopinlfblog.mysql.db;dbname=brunopinlfblog;charset=utf8', 'brunopinlfblog', 'P4Y2ckAY3D');
		return $db;
	}
}
?>