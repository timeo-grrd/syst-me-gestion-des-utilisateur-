<?php
session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD'] ==='POST'){
    $email = trim ($_POST['email']);
    $password = trim ($_POST['password']);

    if ($email ===""|| $password ===""){
        die ("Veuillez remplir tous les champs");
    }

    $user = getUserByEmail($pdo, $email);

// Dans login.php :

// Si l'utilisateur n'existe pas OU si le mot de passe est faux
if (!$user || !password_verify($password, $user['password'])){
    
    // On ferme le PHP pour envoyer du HTML pur
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès Refusé</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center;">
        
        <div>
            
            <h1>
                🚫 ACCÈS REFUSÉ
            </h1>
            
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 30px;">
                Email ou mot de passe incorrect.
            </p>

            <img src="https://media1.tenor.com/m/S5EKaLCuwI8AAAAd/fbi-cat.gif" 
                 alt="Troll" 
                 style>

            <br><br><br>

            <a href="login.php" class="btn" >
                ⬅ Réessayer
            </a>

        </div>

    </body>
    </html>
    <?php
    exit; 
}

    $_SESSION['user_id'] = $user ['id'];
    $_SESSION['user_nom'] = $user ['nom'];

    // on ajoute le roles user ou admin 
    $_SESSION['user_role'] = $user['role_name'];
    header("Location: tableau.php");


    // quand un admin se connecte on le redirige sur une interface diférente 

    if ($_SESSION['user_role']==='admin'){
        header("Location: admin.php");
    }else{
        header("Location: tableau.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="burger.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kedebideri:wght@400;500;600;700;800;900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Menu Burger -->
    <button id="openBtn" class="burger-btn">
      <span class="burger-line"></span>
      <span class="burger-line"></span>
      <span class="burger-line"></span>
    </button>

    <div id="mySidenav" class="sidenav">
      <button id="closeBtn" class="close-btn">&times;</button>
      <a href="index.html">Accueil</a>
      <a href="register.php">Inscription</a>
      <a href="login.php">Connexion</a>
    </div>

    <!-- Navigation principale -->
    <header>
    <nav class="navigation">
        <li><a href="index.html">Accueil</a></li>
        <li><a href="register.php">Inscription</a></li>
        <li><a href="login.php">Connexion</a></li>
    </nav>
    </header>

    <h1 class="bvn">Accèdes à ton compte</h1>
    <form method="POST">
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>
    <div class="field">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div class="actions">
        <button class="bouton" type="submit">Se connecter</button>
        <divc class="login-link">
        <a class="inline-link" href="register.php">Créer un compte</a>
        </div>
    </div>
    </form>  
    <script src="burger.js"></script>
</body>
</html>