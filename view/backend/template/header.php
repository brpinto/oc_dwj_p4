<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./././static/css/backend-style.css">
    <title><?= $title ?></title>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div id="logo" class="logo-elt">
                <a href="./index.php">
                    <img src="./././static/images/logo-min.png" alt="un B sur fond noir">
                </a>
            </div>
            <div class="main-title logo-elt">
                <h1>Billet simple <span class="sub-title">pour l'alaska</span></h1>
            </div>
            <?php

            if (isset($_SESSION['user']) && ($_SESSION['user'] === 'admin'))
            {
                ?>
                <nav id="menu">
                    <ul>
                        <li><a href="./index.php">Blog</a></li>
                        <span class="menu-spacer"></span>
                        <li><a href="./index.php?action=logOut">Déconnexion</a></li>
                    </ul>
                </nav>
                <?php
            }
            ?>
        </div>
    </header>
    <?php require_once('sidebar.php'); ?>
