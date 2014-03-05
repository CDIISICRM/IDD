<?php
require_once('modele/Modele.DAO.php');
require_once('header.php');
require_once('modele/Modele.Role.php');

$mysqli = Connect::getInstance();

if (isset($_POST['valider']))
	{
	$role=new Role($_POST['nomRole']);
	$role->ajouter($mysqli);
	echo "<center><strong>Le rôle a bien été ajouté.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listerole.php">';
	}
else
	{
	echo '
	<form action="ajouter_role.php" method="post" name="form1">
		<table align="center" id="formRole">
			<caption>Ajouter un Role d"un projet </caption>
			<tr>
				<td class="label">
					<span>Nom du Role</span>
				</td>
				<td>
					<input type="text" name="nomRole" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label" colspan="2">
					<input type="button" value="Retour" onClick="Javascript: window.history.back();"/>
					&nbsp;&nbsp;
					<input type="submit" name="valider" value="Ajouter" /> 
				</td>
			</tr>
		</table>
	</form> ';
	}

include('./footer.php');
?>