<?php
session_start();
require "fonctions.php";
requireLogin();
?>

<!DOCTYPE html>
<html lang="fr">
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
    <nav class="navigation">
        <li><a href="index.html">Accueil</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    </nav>

    <h5 class="bvn">Bienvenue sur ma page</h5>
    <h4 class="bvn">vous êtes a présent inscrit</h4>
    <div class="actions">
        <nav class="bas">
        <nav class="navigation">
        <li><a class="btn" href="logout.php">Se déconnecter</a></li>
        <li><a class="btn" href="delete.php">Supprimer son compte</a></li>
        <li><a class="btn" href="index.html">Retour à l'accueil</a></li>
        </nav>
        </nav>
    </div>
</body>
</html>