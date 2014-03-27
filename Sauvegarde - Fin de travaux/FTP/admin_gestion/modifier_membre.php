<?php
require_once('modele/Modele.DAO.php');
require_once('header.php');
require_once('modele/Modele.Personne.php');
require_once('modele/Modele.Role.php');

$mysqli = Connect::getInstance();
			
$getid=$_GET['id'];
if(isset($_POST['valider'] ))
	{ 
	$personne1=new Personne($_POST['nom'],$_POST['prenom'],$_POST['metier'],$_POST['email'],$_POST['idRole'],$getid);
	$personne1->modifier($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
	}
else
	{	
	$personne=Personne::chercher($mysqli, $_GET['id']);

	$leRole = new Role(NULL,NULL);
	$lesRoles = $leRole->listerTout($mysqli);

	$options = '';
	foreach($lesRoles as $unRole)
		{
		$selected = '';
		//echo $personne->idRole.'<br/>';
		if($unRole->getId() == $personne->idRole)
			{
			//echo $unRole->getId().' VS '.$personne->idRole.'<br/>';
			$selected = ' selected="selected"';
			}
		$options .= '<option value="'.$unRole->getId().'"'.$selected.' >'.$unRole->getNomRole().'</option>';
		}

	echo'
	<form action="modifier_membre.php?id='.$getid.'" method="post" name="form1" id="formMembre">
		<table align="center">
			<caption>Modifier un Membre de l"association </caption>
			<tr>
				<td class="label">
					<span>Nom</span>
				</td>
				<td align="left">
					<input type="text" name="nom" value="'.$personne->nom.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Prénom</span>
				</td>
				<td align="left">
					<input type="text" name="prenom" value="'.$personne->prenom.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Métier</span>
				</td>
				<td align="left">
					<input type="text" name="metier" value="'.$personne->metier.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Adresse mail</span>
				</td>
				<td align="left">
					<input type="text" name="email" value="'.$personne->email.'" size="40" />
				</td>
			</tr>

			<tr>
				<td class="label">
					<span>Rôle</span>
				</td>
				<td align="left">
					<select name="idRole" id="idRole">
						'.$options.'
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="label">
					<input type="button" value="Retour" onClick="Javascript: window.history.back();"/>
					&nbsp;&nbsp;
					<input type="submit" name="valider" value="Modifier" /> 
				</td>
			</tr>
		</table>
	</form>';
	}

include('footer.php');
?>