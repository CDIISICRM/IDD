<?php
require_once('header.php');
require_once('modele/Modele.Partenaire.php');
require_once("../include/class_upload.php");

$mysqli = Connect::getInstance();

if (isset($_POST['valider']))
	{
	$obj = new upload('../images/','fichierLogo');
	$obj->cl_taille_maxi = 49000000;
	$obj->cl_extensions = array('.gif','.jpg','.png');
	if ((!$obj->uploadFichier('aleatoire'))&&($obj->cGetNameFile(true)!=''))
		{
		// affichage d'une erreur en cas d'echec
		echo $obj->affichageErreur();
		}
	 else
		{
		$partenaire=new Partenaire($_POST['nom'],$_POST['site'],$obj->cGetNameFileFinal(true),$_POST['sygle']);
		$partenaire->ajouter($mysqli);
		echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
		echo '<meta http-equiv="refresh" content="2;URL=listepartenaire.php">';
		}
	}
else
	{
	echo '
	<form action="ajouter_partenaire.php" method="post" name="form1" enctype="multipart/form-data">
		<table id="formPartenaire">
			<caption>Ajouter un Partenaire d"un projet </caption>
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
					<span>Site Internet</span>
				</td>
				<td>
					<input type="text" name="site" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Sigle</span>
				</td>
				<td>
					<input type="text" name="sygle" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Télécharger le logo</span>
				</td>
				<td>
					<input type="file" name="fichierLogo" value="" placeholder="Placer le fichier ici"/>
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
	</form>';
	}

include('footer.php');
?>