<?php
require_once("modele/Modele.DAO.php");
require_once('header.php');
require_once('modele/Modele.Personne.php');
require_once('modele/Modele.Role.php');

$mysqli = Connect::getInstance();

$lesRoles = Role::listerTout($mysqli);
	
$options = '';
foreach($lesRoles as $unRole)
	$options .= '<option value="'.$unRole->getId().'" >'.$unRole->getNomRole().'</option>';

if (isset($_POST['valider']))
	{
	$personne=new Personne($_POST['nom'],$_POST['prenom'],$_POST['metier'],$_POST['email'],$_POST['idRole']);
	$personne->ajouter($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
	}
else
	{
	echo '
	<h3>Ajouter un membre</h3>
	<form action="ajouter_membre.php" method="post" name="form1">
	<table align="center" id="formMembre">
		<tr>
			<td class="label">
				<span>Nom</span>
			</td>
			<td>
				<input type="text" name="nom" size="40" />
			</td>
		</tr>
		<tr>
			<td class="label">
				<span>Pr&eacute;nom</span>
			</td>
			<td>
				<input type="text" name="prenom" size="40" />
			</td>
		</tr>
		<tr>
			<td class="label">
				<span>Adresse mail</span>
			</td>
			<td>
				<input type="text" name="email" size="40" />
			</td>
		</tr>
		<tr>
			<td class="label">
				<span>Métier</span>
			</td>
			<td>
				<input type="text" name="metier" size="40" />
			</td>
		</tr>
		<tr>
			<td class="label">
				<span>Rôle</span>
			</td>
			<td>
				<select name="idRole" id="idRole">
					'.$options.'
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="label">
				<input type="button" value="Retour" onClick="Javascript: window.history.back();"/>
				&nbsp;&nbsp;
				<input type="submit" name="valider" value="Ajouter" /> 
			</td>
		</tr>
	</table>
	</form>';
	}

include('footer.php');
?>