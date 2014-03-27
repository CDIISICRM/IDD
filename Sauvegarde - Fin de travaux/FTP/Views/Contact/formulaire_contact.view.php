<div class="contactContainer">
    <h1>Formulaire de Contacts : </h1>
    <ul><?php echo $msgError ?></ul>
    <!--form method="POST" action="index.php?controller=Contact&action=EnvoyerFormulaire"-->
		<label for="nom">Nom : </label><input type="text" name="nom" id="nom" value="<?php echo $nom ?>" /><br/>
		<label for="prenom">Prénom : </label><input type="text" name="prenom" id="prenom" value="<?php echo $prenom ?>" /><br/>
		<label for="mail">Courriel : </label><input type="text" name="mail" id="mail" value="<?php echo $mail ?>" /><br/>
		<label for="message">Message : </label><textarea name="message" id="message" cols="50" rows="10" ><?php echo $message ?></textarea><br/><br/>
		<input type="submit" name="Valider" id="Valider" value="Envoyer le message"/>
	<!--/form-->
	<br clear="all"/>
</div>