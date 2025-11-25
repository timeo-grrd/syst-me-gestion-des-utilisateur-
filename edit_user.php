<?php

session_start();
require "fonctions.php";

requireAdmin();

$pdo = getDB();
$message = "";

// traitement du formulaire 
if ($_SERVER['REQUEST_METHOD']==='POST'){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];


if ($id == $_SESSION['user_id'] && $role_id == 1) {
        $message = "⚠️ Sécurité : Vous ne pouvez pas vous retirer vos propres droits d'admin !";
    } 
    // --- FIN DE LA PROTECTION ---
    
    else {
// on met à jours notre base de donnée 
$sql = "UPDATE users SET nom = ?, email = ?, role_id = ? WHERE id = ?";
$stmt = $pdo -> prepare($sql);

if ($stmt -> execute ([$nom, $email, $role_id, $id])){
    header("Location: admin.php");
    exit;
}else{
    $message = "Erreur lors de la modification.";
}
}
}

// Récupération des données 
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id =?");
    $stmt -> execute([$id]);
    $user = $stmt -> fetch();

    if (!$user){
        die ("Utilisateur introuvable.");
    }
    }else {
        header("Location: admin.php");
        exit;
    }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
</head>
<body>
    <nav>
        <a href="admin.php">Retour à la liste</a>
    </nav>

    <h1>Modifier l'utilisateur : <?= htmlspecialchars($user['nom']) ?></h1>

    <?php if($message) echo "<p style='color:red'>$message</p>"; ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <br>
        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
        
        <br><br>
        
        <label>Email :</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        
        <br><br>

        <label>Rôle :</label><br>
        <select name="role_id">
            <option value="1" <?= $user['role_id'] == 1 ? 'selected' : '' ?>>Utilisateur</option>
            <option value="2" <?= $user['role_id'] == 2 ? 'selected' : '' ?>>Administrateur</option>
        </select>

        <br><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</body>
</html>