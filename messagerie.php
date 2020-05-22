<?php
include_once("functions/inOut.php");
include_once("communs/hdp.php");
?>


<section>
    <h1>Messagerie</h1>

    <?php if(isset($_GET['action'])){
        echo '<div id="linkRetour"><a href="messagerie.php">Retour tableau de bord</a></div>';
    }else{
        echo '<div id="linkRetour"><a href="index.php">Retour à l\'accueil</a></div>';
    }
    
    if(!isset($_GET['action'])){
    echo '<div id="contenaireMenuMessagerie">
        <div class="element_contenaireMenuMessagerie"><a href="messagerie.php?action=write">Ecrire un message</a></div>
        <div class="element_contenaireMenuMessagerie"><a href="messagerie.php?action=read">Lire un message</a></div>
    </div>';
    }
    if(isset($_GET['action']) AND $_GET['action'] == "write"){
            include_once("controllers/connect_bdd.php"); //connexion bdd

            $reponse = $bdd->query('SELECT * FROM members WHERE id <> '.$_SESSION['userId'] );
            ?>
                <form id="formWriteMessage" method="post" action="/controllers/verifWriteMessage.php">
                    <div class="element_formWriteMessage"><label>Ecrire à : </label></div>
                    <div class="element_formWriteMessage"><label><select name="destinataire">
                    <option value="">...</option>
                    <?php
                    while ($donnees = $reponse->fetch()){
                        echo '<option value="'.$donnees['id'].'">'.$donnees['pseudo'].'</option>';
                        }
                    ?>    
                    </select></label></div>
                    <div class="element_formWriteMessage"><label>Votre message:</label></div>
                    <div class="element_formWriteMessage"><label><textarea name="message" rows="5" cols="33"></textarea></label></div>
                
               
                
                 <p><input class="bouton" type="submit" value="Se connecter" /></p>
                </form>

    <?php   
    } 
////////////////////////////////////  FIN DE LA SECTION ECRIRE MESSAGE ////////////////////////////////////////////
    
        if(isset($_GET['action']) AND $_GET['action'] == "read"){
            include_once("controllers/connect_bdd.php"); //connexion bdd

            $userId = $_SESSION['userId'];
            $lu = "0";
            $req = $bdd->prepare('SELECT * FROM members WHERE id_toMember = :userId AND lu = :lu ');
            $req->execute(array(
            'userId' => $userId,
            'lu' => $lu));
            $nb = $req->rowCount();
                echo $nb;
            if($nb < 1){
                echo '<div id="contenaireMessageToRead"><div class="element_contenaireMessageToReadEmpty">Aucun message !</div></div>';
            }else{
                echo '<div id="contenaireMessageToRead">';
                    while ($donnees = $reponse->fetch()){
                        $reponseMembers = $bdd->query('SELECT * FROM members WHERE id = '.$donnees['id_fromMember'] );
                        $donneesMembers = $reponseMembers->fetch();
                        echo '<div class="element_contenaireMessageToRead">Message de: '.$donneesMembers['pseudo'].' écrit le '.date('m/d/Y H:i:s', $donneesMembers['date']).'</div>';
                        echo '<div class="element_contenaireMessageToRead">'.$donnees['texte'].'</div>';
                        }
                echo '</div>';
            }
        }
////////////////////////////////////  FIN DE LA SECTION LIRE MESSAGE ////////////////////////////////////////////
        ?>
</section>
<?php include_once("communs/bdp.php"); ?>