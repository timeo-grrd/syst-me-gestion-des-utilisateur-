<?php
// permet de retourner sur la page de connexion lors de la supression du compte 
session_start();
require "fonctions.php";
$pdo = getDB();

deleteAccount ($pdo, $_SESSION['user_id']);

header("Location:index.html");
exit;

?>