<?php
session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD']==='POST'){
    $nom = trim ($_POST['nom']);
    $email = trim ($_POST['email']);
    $adresse = trim ($_POST['adresse']);
    $motdepasse = trim ($_POST['motdepasse']);
    $confirmation = trim ($_POST['confirmation']);

    if ($nom === ""|| $email ===""|| $adresse ===""||$motdepasse ===""|| $confirmation ===""){
    die ("Veuillez remplir tous les champs.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die ("Email invalide.");
    }

    if ($motdepasse !== $confirmation){
    die("Veuillez saisir les même mot de passe !");
    }

    if (emailExist ($pdo, $email)){
    die("Cet email existe déjà.");
    }

    $motdepasseHash = motdepasse_hash ($motdepasse, PASSWORD_DEFAULT);


    if (creerUtilisateur ($pdo, $nom, $email, $adresse, $motdepasseHash)){
    echo "Félicitation vous êtes inscrit. <a href='login.php'>Se connecter</a>";
    } else{
    echo "Erreur lors de l'inscription, veuillez réssayer"
    }
}

?>

<!DOCTYPE html>
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
                <label for="motdepasse">Mot de passe</label>
                <input id="motdepasse" type="password" name="motdepasse" required >
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