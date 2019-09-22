<?php ob_start(); ?>

<h1>Inscription</h1>
<form action="./index.php?action=addUser" method="post">
    <label for="pseudo">Pseudo</label>
    <p><input type="text" id="pseudo" name="pseudo"></p>
    <label for="pswd">Mot de passe</label>
    <p><input type="password" id="pswd" name="pswd"></p>
    <label for="pswd_confirm">Confirmation du mot de passe</label>
    <!-- vérification de l'équivalence de pswd/pswd_confirm en JS -->
    <p><input type="password" id="pswd_confirm" name="pswd_confirm"></p>
    <label for="mail">Mail</label>
    <p><input type="text" id="mail" name="mail"></p>
    <button>S'inscrire</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template/base.php'); ?>
