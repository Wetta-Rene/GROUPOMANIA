<?php include_once("communs/hdp.php"); ?>
<section>
    <h1>Inscription</h1>

    <form method="post" action="/controllers/verifInscription.php">
        <label>Pseudo:</label><label><input type="text" name="pseudo" id="pseudo" required /></label>
        <label>Mot de passe:</label><label><input type="password" name="password1" id="password1" required /></label>
        <label>Confirmation du mot de passe:</label><label><input type="password" name="password2" id="password2" required /></label>
        <label>Vous êtes:</label>
        <label><select name="level" id="level">
                <option value="1">Technicien.ne</option>
                <option value="2">Chef.e de secteur</option>
                <option value="3">Chargé.e de communication</option>
            </select></label>
        <input type="submit" value="S'inscrire" />
    </form>

</section>
<?php include_once("communs/bdp.php"); ?>