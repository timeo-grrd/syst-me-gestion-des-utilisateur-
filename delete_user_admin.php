<?php
session_start();
require "fonctions.php";

requireAdmin();

// on vérifieque l'on a bien un id dans l'url 
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $pdo = getDB();

    // sécurité pour pas supprimé son propre compte 
    if ($id != $_SESSION['user_id']){
        deleteAccount($pdo, $id);
    }
}
header("Location: admin.php");
exit;

?>