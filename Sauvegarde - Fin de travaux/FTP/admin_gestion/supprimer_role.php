<?php
require_once('modele/Modele.DAO.php');
require_once('header.php');
require_once('modele/Modele.Role.php');

$mysqli = Connect::getInstance();

$getid=$_GET['id'];

if(isset($_POST['valider'] ))
	{ 
	$role1=new Role($_POST['nomRole'],$getid);
	$role1->supprimer($mysqli);
	if (!$mysqli->errno)
		{
		echo "<center><strong>La suppression a bien été enregistrée.</strong></center>";
		echo '<meta http-equiv="refresh" content="2;URL=listerole.php">';
		}
	else
		{
		echo '<center><strong>Entrée impossible à supprimer : une personne occupe ce rôle.</strong></center>';
		echo '<meta http-equiv="refresh" content="2;URL=listerole.php">';
		}
	}
else
	{
	$role=Role::chercher($mysqli, $_GET['id']);


	echo'
	<form action="supprimer_role.php?id='.$getid.'" method="POST" name="form1">
		<table align="center" id="formRole">
			<caption>Supprimer un Role</caption>
			<tr>
				<td class="label">
					<label>Nom</label>
				</td>
				<td>
					<input type="text" readonly  name="nomRole" value="'.$role->getNomRole().'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label" colspan="2">
					<input type="button" value="Retour" onClick="Javascript: window.history.back();"/>
					&nbsp;&nbsp;
					<input type="submit" name="valider" value="Supprimer ?" /> 
				</td>
			</tr>
		</table>
	</form>';
	}
include('footer.php');
?>