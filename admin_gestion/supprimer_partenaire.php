<?php
require_once('header.php');
require_once('modele/Modele.Partenaire.php');

$mysqli = Connect::getInstance();

$getid=$_GET['id'];
$Partenaire=Partenaire::chercher($mysqli, $_GET['id']);

if(isset($_POST['valider'] ))
	{ 
	$partenaire1=new Partenaire($_POST['nom'],$_POST['site'],$_POST['sygle'],$Partenaire->logo,$getid);
	$partenaire1->supprimer($mysqli);
	if (is_file('../images/'.$Partenaire->logo)) unlink('../images/'.$Partenaire->logo);
	echo "<center><strong>La suppression a été enregistrée.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listepartenaire.php">';
	}
else
	{
	echo '
	<form action="supprimer_partenaire.php?id='.$getid.'" method="post" name="form1" enctype="multipart/form-data">
		<table align="center" id="formPartenaire">
			<caption>Supprimer un Partenaire d"un projet </caption>
			<tr>
				<td class="label">
					<span>Nom</span>
				</td>
				<td>
					<input type="text" readonly name="nom" value="'.$Partenaire->nom.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Site Internet</span>
				</td>
				<td>
					<input type="text" readonly name="site" value="'.$Partenaire->siteInternet.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Sigle</span>
				</td>
				<td>
					<input type="text" readonly name="sygle" value="'.$Partenaire->sygle.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Logo actuel</span>
				</td>
				<td>
					<img src="../images/'.$Partenaire->logo.'" alt="Logo" height="150px" />
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