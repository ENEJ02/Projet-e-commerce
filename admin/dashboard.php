<?php


$title = "Backoffice";
require_once "../inc/header.inc.php";
?>

<main>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-2">

            <div class="d-flex flex-column text-bg-dark p-3 sidebarre">

                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="?dashboard_php" class="nav-link text-light">Backoffice</a>
                    </li>
                    <li>
                        <a href="?maillot_php" class="nav-link text-light">Maillots</a>
                    </li>
                    <li>
                        <a href="?equipes_php" class="nav-link text-light">Club</a>
                    </li>
                    <li>
                        <a href="?users_php" class="nav-link text-light">Utilisateurs</a>
                    </li>

                </ul>
            </div>
        </div>

        <?php
        if (isset($_GET['dashboard_php'])) :
        ?>

            <div class="w-50 m-auto">
                <h2><?= (isset($_SESSION['user'])) ? "Bonjour chèrs " . $_SESSION['user']['firstName'] : "Please Login" ?></h2>
                <p>Bienvenue sur le backoffice</p>
                <img src="<?= RACINE_SITE ?>assets/img/barcelone.jpg" alt="Affiche des maillots sur le backoffice" width="500" height="800">
            </div>

        <?php

        endif;

        ?>
</main>
        