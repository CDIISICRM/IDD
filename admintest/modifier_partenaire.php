<?php
require_once('header.php');
require_once('modele/Modele.Partenaire.php');
require_once("../include/class_upload.php");

$mysqli = Connect::getInstance();

$getid=$_GET['id'];

$Partenaire=Partenaire::chercher($mysqli, $_GET['id']);

if(isset($_POST['valider'] ))
	{ 
	$oldLogo=$Partenaire->logo;
	if (($_FILES['fichierLogo']['name']!=''))//on change le logo
		{
		$obj = new upload('../images/','fichierLogo');
		$obj->cl_taille_maxi = 49000000;
		$obj->cl_extensions = array('.gif','.jpg','.png');
		if (!$obj->uploadFichier('aleatoire'))
			{
			// affichage d'une erreur en cas d'echec
			echo $obj->affichageErreur();
			}
		else
			{
			if (is_file('../images/'.$oldLogo)) unlink('../images/'.$oldLogo);
			$partenaire=new Partenaire($_POST['nom'],$_POST['site'],$obj->cGetNameFileFinal(true),$_POST['sygle'],$_GET['id']);
			}
		}
	 else
		{
		//on conserve l'ancien logo
		 $partenaire=new Partenaire($_POST['nom'],$_POST['site'],$oldLogo,$_POST['sygle'],$_GET['id']);
		}
	$partenaire->modifier($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listepartenaire.php">'; 
	}	
else
	{
	echo '
	<form action="modifier_partenaire.php?id='.$getid.'" method="post" name="form1" enctype="multipart/form-data">
		<table align="center" id="formPartenaire">
			<caption>Modifier un Partenaire d"un projet </caption>
			<tr>
				<td class="label">
					<span>Nom</span>
				</td>
				<td>
					<input type="text" name="nom" value="'.$Partenaire->nom.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Site Internet</span>
				</td>
				<td>
					<input type="text" name="site" value="'.$Partenaire->siteInternet.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Sigle</span>
				</td>
				<td>
					<input type="text" name="sygle" value="'.$Partenaire->sygle.'" size="40" />
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
				<td class="label">
					<span>Télécharger le logo</span>
				</td>
				<td>
					<input type="file" name="fichierLogo" value="" placeholder="Modifier le fichier ici"/>
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