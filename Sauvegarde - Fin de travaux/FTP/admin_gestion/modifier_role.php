<?php
require_once('modele/Modele.DAO.php');
require_once('header.php');
require_once('modele/Modele.Role.php');

$mysqli = Connect::getInstance();

$getid=$_GET['id'];

if(isset($_POST['valider'] ))
	{ 
	$role1=new Role($_POST['nomRole'],$getid);
	$role1->modifier($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listerole.php">';
	}
else
	{
	$role=Role::chercher($mysqli, $_GET['id']);

	echo '
	<form action="modifier_role.php?id='.$getid.'" method="POST" name="form1">
		<table align="center" id="formRole">
			<caption>Modifier un Role</caption>
			<tr>
				<td class="label">
					<span>Nom</span>
				</td>
				<td>
					<input type="text" name="nomRole" value="'.$role->getNomRole().'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label" colspan="2">
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