<?php
session_start();
require "fonctions.php";

// accès réservé à l'admin 
requireAdmin();
$pdo = getDB();
$users = getAllUsers($pdo);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kedebideri:wght@400;500;600;700;800;900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Administrateur</title>
    
</head>
<body>
    <nav class="bvn">
        <li><a href="tableau.php">Retour sur le tableau principal</a></li>
       <li><a href="logout.php">Déconnexion</a></li>
    </nav>
<h1>Gestion des utilisateurs</h1>
<div style="margin-bottom: 20px;">
    <a href="register.php" style="background-color: green; color: white; padding: 10px; text-decoration: none;">
        + Ajouter un utilisateur
    </a>
</div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th> </tr>
                </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><strong><?= htmlspecialchars($user['role_name']) ?></strong></td>
                
                <td>
                    <a href="edit_user.php?id=<?= $user['id'] ?>">Modifier</a>
                    
                    &nbsp;|&nbsp; 

                    <a href="delete_user_admin.php?id=<?= $user['id'] ?>" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                       Supprimer
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
            
    </table>
    
</body>
</html>
