<?php include_once("communs/hdp.php"); ?>
<section>
    <h1>Connexion</h1>

    <form id="formConnect" method="post" action="/controllers/verifConnect.php">
        <div class="element_formConnect"><label>Pseudo:</label></div>
        <div class="element_formConnect"><label><input type="text" name="pseudo" id="inputPseudo" required /></label></div>
        <div class="element_formConnect"><label>Mot de passe:</label></div>
        <div class="element_formConnect"><label><input type="password" name="password1" id="inputPassword1" required /></label></div>
        <p><input class="bouton" type="submit" value="Se connecter" /></p>
    </form>

</section>
<?php include_once("communs/bdp.php"); ?>