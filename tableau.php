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
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kedebideri:wght@400;500;600;700;800;900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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