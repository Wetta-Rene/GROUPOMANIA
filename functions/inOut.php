<?php
session_start();
if (!isset($_SESSION['userId'])) 
{

                $_SESSION['messageUtilisateur'] = "Vous n'avez pas accès à cette section du site !";
                header('Location: ../index.php');
}
?>