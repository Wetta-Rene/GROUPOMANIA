<?php
session_start();
session_destroy(); // on detruit la session

session_start(); // on recommence

        $_SESSION['messageUtilisateur'] = "Vous êtes bien déconnecté.e";
        header('Location: ../index.php');
        exit();
?>