<?php ob_start(); ?>
<div class="container login-container">
    <h1>Bonjour :)</h1>
    <p>Merci de renseigner ton nom et ton mot de passe</p>
    <form action="./index.php?action=logIn" method="post">
        <p><input type="text" name="pseudo" id="pseudo" placeholder="ton pseudo"></p>
        <p><input type="password" name="mdp" id="mdp" placeholder="ton mot de passe"></p>
        <button type="submit">Connexion</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template/base.php'); ?>
