<?php
$title = "Gestion / Maillots";
include_once "../inc/functions.inc.php";


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $pdo = connexionBdd();
    $id_maillot = $_GET['id_maillot'];
    // Delete the user with the specified id_film
    $sql = "DELETE FROM maillots WHERE id_maillot = :id";
    $stmt = $pdo->prepare($sql);
    // $stmt->bind_param("i", $id_film);
    $stmt->execute(array(
        ":id" => $id_maillot
    ));
    // Redirect the user back to the user list
    header("Location: " . RACINE_SITE . "admin/dashboard.php?maillots_php");
    exit();
}



// update  *******************

if (isset($_GET['action']) && $_GET['action'] == 'update') {
    $id_film = $_GET['id_film'];

    $pdo = connexionBdd();
    $sql = "SELECT * FROM films WHERE id_film = $id_film";
    $request = $pdo->query($sql);
    $film = $request->fetch();

    // function doUpdateFilm($id_film, $category_id, $title, $directors, $actors, $ageLimit, $duration, $synopsis, $date, $image, $price, $stock){

    //     updateFilm($id_film, $category_id, $title, $directors, $actors, $ageLimit, $duration, $synopsis, $date, $image, $price, $stock);
    // }


    // $category_id = $film['category_id'];
}