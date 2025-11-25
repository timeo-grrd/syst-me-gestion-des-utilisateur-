<?php
session_start();
require "fonctions.php";
requireLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <nav class="nav-links">
        <a href="index.html">Accueil</a>
        <a href="logout.php">Déconnexion</a>
    </nav>

    <h5>Bienvenue sur ma page</h5>
    <h4>vous êtes a présent inscrit</h4>
    <div class="actions">
        <a class="btn" href="logout.php">Se déconnecter</a>
        <a class="btn" href="delete.php">Supprimer son compte</a>
        <a class="btn" href="index.html">Retour à l'accueil</a>
    </div>
</body>
</html>