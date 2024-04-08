<?php

require_once "inc/functions.inc.php";


if (!empty($_SESSION['user'])) {
    // Un utilisateur est connecté
    if ($_SESSION['user']['role'] === 'admin') {
        // L'utilisateur connecté est un administrateur
        header("Location: " . RACINE_SITE . "admin/dashboard.php");
    } else {
        // L'utilisateur connecté n'est pas un administrateur
        header("Location: " . RACINE_SITE . "index.php");
    }
} else {
    // Aucun utilisateur n'est connecté
    header("Location: " . RACINE_SITE . "authentification.php");
}





$title = "Profil";
require_once "inc/header.inc.php";
?>

<main>
    <h2 class="text-center">Bonjour <?=$_SESSION['user']['firstName'] ? $_SESSION['user']['firstName'] : "Degage-toi"?></h2>

</main>
