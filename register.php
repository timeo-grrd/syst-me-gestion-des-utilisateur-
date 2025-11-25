<?php
// formulaire d'inscription 
session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD']==='POST'){
    $nom = trim ($_POST['nom']);
    $email = trim ($_POST['email']);
    $adresse = trim ($_POST['adresse']);
    $password = trim ($_POST['password']);
    $confirmation = trim ($_POST['confirmation']);

    if ($nom === ""|| $email ===""|| $adresse ===""||$password ===""|| $confirmation ===""){
    die ("Veuillez remplir tous les champs.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die ("Email invalide.");
    }

    if ($password !== $confirmation){
    die ("Veuillez saisir les même mot de passe !");
    }

    if (emailExist ($pdo, $email)){
    die ("Cet email existe déjà.");
    }

    $passwordHash = password_hash ($password, PASSWORD_DEFAULT);


    if (creerUtilisateur ($pdo, $nom, $email, $adresse, $passwordHash)){
    echo "Félicitation vous êtes inscrit. <a href='login.php'>Se connecter</a>";
    } else{
    echo "Erreur lors de l'inscription, veuillez réssayer";
    }
}
?>

<!DOCTYPE html>
<!-- ajout du formulaire d'inscription  -->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription site </title>
</head>
<body>
    <main>
        <form method="POST">
            <div class="field">
                <label for="nom">Nom</label>
                <input id="nom" type="text" name="nom" required>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            <div class="field">
                <label for="adresse">Adresse postale</label>
                <input id="adresse" type="text" name="adresse" placeholder="N° et rue, Ville" required >
            </div>
            
            <div class="field">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required >
            </div>
            
            <div class="field">
                <label for="confirmation">Confirmez votre mot de passe</label>
                <input id="confirmation" type="password" name="confirmation" required >
            </div>

            <div class="actions">
                <button class="bouton" type="submit">S'inscrire</button>
            </div>
            





        </form>
    </main>
</body>
</html>