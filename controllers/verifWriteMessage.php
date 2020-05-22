<?php
include_once("../functions/inOut.php");

if (isset($_POST['message']) AND isset($_POST['destinataire'])) // on vient de valider le formulaire
{
    // on protege les futures insertions et on crée des variables plus facile
    $message = htmlspecialchars ($_POST['message']);
    $userId = htmlspecialchars ($_SESSION['userId']);
    $destinataire = htmlspecialchars ($_POST['destinataire']);
    $date = time();

	//on se connecte et on verifie si le pseudo existe deja, si c'est non c'est bon sinon on revient en arriere a l'inscription
    include_once("connect_bdd.php");
        
        $req = $bdd->prepare('INSERT INTO messages(id_fromMember, id_toMember, texte, date, lu) VALUES(:idFrom, :idTo, :message, :date, :lu)');
        try{
        $req->execute(array(
            'idFrom' => $userId,
            'idTo' => $destinataire,
            'message' => $message,
            'date' => $date,
            'lu' => 0
            ));
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
        $_SESSION['messageUtilisateur'] = "Message envoyé !";
        header('Location: ../messagerie.php');
        exit();
   
}
else // Il manque des paramètres, on avertit le visiteur
{
    $_SESSION['messageUtilisateur'] = "Erreur:<br />Il manque un champs dans la transmission des données !";
    header('Location: ../messagerie.php');
  exit();
}
?>