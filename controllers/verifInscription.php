<?php
session_start();

if (isset($_POST['pseudo']) AND isset($_POST['level']) AND isset($_POST['password1']) AND isset($_POST['password2'])) // On a le nom et le prénom
{
    // on protege les futures insertions et on crée des variables plus facile
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password1 = htmlspecialchars($_POST['password1']);
    $password2 = htmlspecialchars($_POST['password2']);
    $level = $_POST['level'];
    
    
    //on compare les mots de passe
    if($password1 != $password2){ // ce n'est pas les meme
            $_SESSION['messageUtilisateur'] = "Erreur:<br />Les mots de passe ne sont pas identique !";
            header('Location: ../inscription.php');
            exit();   
    }else{
        $passwordHash = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    }

	//on se connecte et on verifie si le pseudo existe deja, si c'est non c'est bon sinon on revient en arriere a l'inscription
    include_once("connect_bdd.php");
        $req = $bdd->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
        $req->execute(array(
        'pseudo' => $pseudo));
        $count = $req->rowCount();

        if($count > 0){ // existe dans la base
            $_SESSION['erreur'] = "Le pseudo choisi existe déjà !";
            header('Location: ../index.php');
            exit();  
        }else{ // tout est bon on saisie dans la base
            $req = $bdd->prepare('INSERT INTO members(pseudo, password, level) VALUES(:pseudo, :password, :level)');
                $req->execute(array(
                    'pseudo' => $pseudo,
                    'password' => $passwordHash,
                    'level' => $level
                    ));

            $_SESSION['messageUtilisateur'] = "Inscription réussie, identifiez- vous !";
            header('Location: ../connect.php');
            exit();  
            
        }
}
else // Il manque des paramètres, on avertit le visiteur
{
    $_SESSION['messageUtilisateur'] = "Erreur:<br />Il manque un champs dans la transmission des données !";
    header('Location: ../inscription.php');
  exit();
}
?>