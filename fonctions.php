<?php

// connexion pdo à la base de donnée 
function getDB() {
    $host = "localhost";
    $dbname = "gest_users_tim";
    $username = "root";
    $password = "";

    try {
        return new PDO(
            "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }catch (PDOException $e) {
        die("Erreur de connexion BDD:".$e->getMessage());
    }
}

// Vérifie si un email existe déjà

function emailExiste ($pdo, $email){
    $stmt = $pdo -> prepare ("SELECT  id FROM users WHERE email =?");
    $stmt ->execute ([$email]);
    return $stmt -> rowCount() > 0;
}

// Inscription d'un utilisateur 
function creerUtilisateur ($pdo, $nom, $email, $passwordHash, $adresse){
    $stmt = $pdo-> prepare ("INSERT INTO users (nom, email, password, adresse) VALUES (?, ?, ?, ?)");
    return $stmt ->execute ([$nom, $email, $passwordHash, $adresse]);
}

// Récupérer un utilisateur par email ainsi que son role

function getUserByEmail ($pdo, $email){
    $sql = "SELECT users.*, roles.name as role_name FROM users JOIN roles ON users.role_id = roles.id WHERE email = ?";
    $stmt = $pdo-> prepare ($sql);
    $stmt -> execute ([$email]);
    return $stmt -> fetch ();
}

function getAllUsers($pdo){
    $sql = "SELECT users.*, roles.name as role_name FROM users JOIN roles ON users.role_id = roles.id ORDER BY users.id DESC";
    $stmt = $pdo -> query($sql);
    return $stmt ->fetchAll();
}

function requireAdmin(){
    if (!isLogged() || $_SESSION['user_role'] !== 'admin'){
        header("Location: tableau.php");
        exit;
    }
}




// Vérifier si un utilisateur est connecté 
function isLogged(){
    return isset($_SESSION['user_id']);
}

// Bloquer une page si non connecté
function requireLogin(){
    if (!isLogged()){
        header("Location: login.php");
        exit;
    }
}


function deleteAccount ($pdo, $id){
    $stmt = $pdo->prepare("DELETE FROM users WHERE id =?");
    $stmt->execute([$id]);

}



?>