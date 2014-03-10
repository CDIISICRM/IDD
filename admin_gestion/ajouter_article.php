<?php
require_once('header.php');
require_once('modele/Modele.Presse.php');
require_once("../include/class_upload.php");

$mysqli = Connect::getInstance();
$error = '';
/*

			print('<pre>POST');		
			print_r($_POST);
			print('</pre>');
			
			print('<pre>FILES');		
			print_r($_FILES);
			print('</pre>');
*/

if (isset($_POST['valider']))
	{
	$error = false;
	$obj = false;
	if(isset($_FILES['fichierArticle']) && $_FILES['fichierArticle']['name'] != '')
		{
		$obj = new upload('../media/','fichierArticle');
		$obj->cl_taille_maxi = 49000000;
		$obj->cl_extensions = array('.pdf');
		if ((!$obj->uploadFichier())&&($obj->cGetNameFile(true)!=''))
			{
			// affichage d'une erreur en cas d'echec
			$error .= '<p class="error">'.$obj->affichageErreur().'</p>';
			}
		}
		
	
	if($_POST['titre'] == '' || ($_POST['lien'] == '' && $_FILES['fichierArticle']['name'] == ''))
		$error .= '<p class="error">Vous devez saisir au moins un titre et un lien ou charger un fichier</p>';

	if(!$error)
		{
		if(!$obj)
			$fichier  = '';
		else
			$fichier = $obj->cGetNameFileFinal(true);
			
		$presse=new Presse($_POST['titre'],$_POST['source'],$_POST['auteur'],$_POST['lien'],$fichier,$_POST['dateParution']);
		/*print('<pre>POST');		
		print_r($_POST);
		print('</pre>');
		
		print('<pre>FILES');		
		print_r($_FILES);
		print('</pre>');*/
		
		
		$presse->ajouter($mysqli);
		echo "<center><strong>L'article a bien été enregistré.</strong></center>";
		echo '<meta http-equiv="refresh" content="2;URL=listearticles.php">';
		}
	}
	
if(empty($_POST['valider']) || $error)
	{
	echo $error.'
	<form action="ajouter_article.php" method="post" name="form1" enctype="multipart/form-data">
		<table id="formpresse">
			<caption>Ajouter un Article de presse </caption>
			<tr>
				<td class="label">
					<span>Titre</span>
				</td>
				<td>
					<input type="text" name="titre" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Source</span>
				</td>
				<td>
					<input type="text" name="source" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Auteur</span>
				</td>
				<td>
					<input type="text" name="auteur" size="40" />
				</td>
			</tr>			
			<tr>			
				<td class="label">
					<span>Lien</span>
				</td>
				<td>
					<input type="text" name="lien" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Date de Parution</span>
				</td>
				<td>
					<input type="text" id="datePick"  name="dateParution" size="40" />
				</td>
			</tr>			
			<tr>
				<td class="label">
					<span>Uploader l\'article</span>
				</td>
				<td>
					<input type="file" name="fichierArticle" value="" placeholder="Placer le fichier ici"/>
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
 		<script>$("#datePick").datepicker({dateFormat : "yy-mm-dd"});</script>
	</form>';
	}

include('footer.php');
?>