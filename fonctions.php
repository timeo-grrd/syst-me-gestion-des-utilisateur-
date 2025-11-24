<?php

// connexion pdo à la base de donnée 
function getDB() {
    $host = "localhost";
    $dbname = "gestion_users";
    $username = "root";
    $password = "";

    try {
        return new PDO(
            "mysql:host=$host;port=3006;dbname=$dbname;charset=utf8",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETcdCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }catch (PDOException $e) {
        die("Erreur de connexion BDD:".$e->getMessage());
    }

    

}



?>