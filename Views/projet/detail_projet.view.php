<div class="projetContainer">
	<input type="button" value="Retour aux projets" onClick="Javascript:window.history.back();" />
	<h1 align="center"><?php echo $nom ?></h1>
	<div <?php echo $specialSize ?> >     
	
	<?php echo $photo1; ?>
		<h2>Objectif: </h2>
		<p><?php echo $objectifs ?></p>
	</div>
	<div>  
	  <?php echo $photo2 ?>
	  <h2>Date : </h2>
	  <p><?php echo formatDate($date) ?></p>
	  <h2>Description de l'état du projet : </h2>
	  <p><?php echo $etatActuel ?></p>
	  <h2>Partenaire(s) associé(s) : </h2>
	   <ul><?php echo $listePartenaire; ?></ul>
	</div>
	<br clear="all"/>
</div>