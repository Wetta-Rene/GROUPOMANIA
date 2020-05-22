<?php session_start(); ?>
<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link type="text/css" rel="stylesheet" href="CSS/design.css" />
    <title>Groupomonia</title>
</head>

<body>
    <header>
        <div id="headerDivImg">
            <img src="/css/images/icon-above-font.png" />
        </div>
    </header>
    <nav>
        <?php
        if(isset($_SESSION['pseudo'])){
            echo '<div class="navLink">Bonjour '.$_SESSION['pseudo'].'</div>
        <div class="navLink"><a href="/controllers/disconnect.php">Déconnexion</a></div>';
        }else{
            echo '<div class="navLink"><a href="/inscription.php">Inscription</a></div>
        <div class="navLink"><a href="/connect.php">Connexion</a></div>'; 
        }
        ?>
    </nav>
<?php
    if(isset($_SESSION['messageUtilisateur'])){
        echo '<div id="messageUtilisateur">'.$_SESSION['messageUtilisateur'].'</div>';
        unset($_SESSION['messageUtilisateur']); // on detruit la variable
    }
?>
    