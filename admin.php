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
    <title>Administrateur</title>
    
</head>
<body>
    <nav>
        <a href="tableau.php">Retour au profil</a>
        <a href="logout.php">Déconnexion</a>
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
