<?php
require_once('Manager.php');

class UserManager extends Manager
{
    /*public function addUser($pseudo, $password, $mail)
    {
        $db = $this->dbConnect();
        $user = $db->prepapre('INSERT INTO users(pseudo, password, mail) VALUES(:pseudo, :password, :mail)');
        $affectedLine = $user->execute(array(
           "pseudo" => $pseudo,
           "password" => $password,
            "mail" => $mail
        ));

        return $affectedLine;
    }*/

    public function getUser($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, password FROM users where pseudo = ?');
        $req->execute(array($pseudo));
        $user = $req->fetch();

        return $user;
    }
}