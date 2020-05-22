<?php
session_start();

if (isset($_POST['pseudo']) AND isset($_POST['password1'])) 
{
    // on protege les futures insertions et on crée des variables plus facile
    $pseudo = htmlspecialchars ($_POST['pseudo']);
    $password1 = htmlspecialchars ($_POST['password1']);
    
    include_once("connect_bdd.php"); //connexion bdd

    // Si tout va bien, on peut continuer

    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $pseudo));
    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['password1'], $resultat['password']);

    if (!$resultat)
        {
                $_SESSION['messageUtilisateur'] = "Pseudo non reconnu !";
                header('Location: ../connect.php');
                exit();
        }
        else
        {
            if (!$isPasswordCorrect) {
                $_SESSION['messageUtilisateur'] = "Mauvais mot de passe !";
                header('Location: ../connect.php');
                exit();
            }
            else {
                $_SESSION['messageUtilisateur'] = "Vous êtes connecté.e !";
                $_SESSION['pseudo'] = $resultat['pseudo'];
                $_SESSION['userId'] = $resultat['id'];
                header('Location: ../index.php');
                exit();
            }
        }
}
else // Il manque des paramètres, on avertit le visiteur
{
    $_SESSION['messageUtilisateur'] = "Erreur:<br />Il manque un champs dans la transmission des données !";
    header('Location: ../connect.php');
  exit();
}
?>