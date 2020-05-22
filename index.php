<?php include_once("communs/hdp.php"); ?>


<section>
    <?php
include_once("controllers/connect_bdd.php"); //connexion bdd

// Si tout va bien, on peut continuer



if(isset($_SESSION['userId'])){// si le membre est connecte
    $reponseMessages = $bdd->query('SELECT * FROM messages WHERE id_toMember = '.$_SESSION['userId'].' AND lu = "0" ');
    $result = $reponseMessages->fetch();
    $nb = count($result);
}else{
    $nb = "0";
}
    

 if(isset($_SESSION['pseudo'])){
    echo '
<div class="choixForum">
    <div class="choixForumDetail">
        <a href="messagerie.php">Messagerie<span class="spanNbrAlire">('.$nb.')</span></a>
    </div>
    <div class="choixForumDetail">
        <a href="">Gallerie photos</a>
    </div>
</div>';
}else{
      echo '
<div class="choixForum">
    <div class="choixForumDetail">Messagerie</div>
    <div class="choixForumDetail">Gallerie photos</div>
</div>';
}

    
    if(!isset($_SESSION['pseudo'])){
        echo '<div id="informationChoixForum">Vous devez être connecté.e pour pouvoir utiliser la plateforme...</div>';
    }
?>
</section>
<?php include_once("communs/bdp.php"); ?>