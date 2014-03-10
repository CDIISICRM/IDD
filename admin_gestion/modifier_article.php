<?php

include ('modele/Modele.DAO.php');
require_once('header.php');
//require_once('../include/connect.php'); 
require_once('modele/Modele.Presse.php');
require_once("../include/class_upload.php");

?>



<?php
$mysqli = Connect::getInstance();
//echo $_GET['id'];
$getid=$_GET['id'];
/*echo"getid=".$getid;*/
$presse=Presse::chercher($mysqli, $_GET['id']);


if(isset($_POST['valider'] ))
{ 
	$oldpdf=$presse->pdf;
	$presse1= Presse::chercher($mysqli,$getid);
	$presse1->titre = $_POST['titre'];
	$presse1->source = $_POST['source'];
	$presse1->auteur = $_POST['auteur'];
	$presse1->lien = $_POST['lien'];
	$presse1->dateParution = $_POST['dateParution'];
	
if (($_FILES['fichierArticle']['name']!=''))//on change le pdf
	{
		if (is_file('../media/'.$_FILES['fichierArticle']['name'])) //Le nouveau fichier porte le même nom que l'ancien :on écrase l'ancien
		{
		  $obj = new upload('../media/','fichierArticle');
		  $obj->cl_taille_maxi = 49000000;
		  $obj->cl_extensions = array('.pdf');
		  if (!$obj->uploadFichier())
			  {
			  // affichage d'une erreur en cas d'echec
			  echo $obj->affichageErreur();
			  }
		  else
			  {
			  $presse1->pdf=$obj->cGetNameFileFinal(true);
			  }
		  }
		 else //Le nouveau fichier porte un autre nom : si l'upload est bon on supprime le précédent
		 {
			 $obj = new upload('../media/','fichierArticle');
		 	 $obj->cl_taille_maxi = 49000000;
		  	$obj->cl_extensions = array('.pdf');
			if (!$obj->uploadFichier())
				{
				// affichage d'une erreur en cas d'echec
				echo $obj->affichageErreur();
				}
			else
				{
					if (is_file('../media/'.$oldpdf)) unlink('../media/'.$oldpdf);
				  	$presse1->pdf=$obj->cGetNameFileFinal(true);
				}
		  } 
	}
else //On garde le pdf
	{
		$presse1->pdf=$oldpdf;
	}
	$presse1->modifier($mysqli);
	
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listearticles.php">';
}
else
{

	
/*$rq="select date,titre,texte from evenements where id=".$_GET['id'];											
$rquery=@mysql_db_query($base,$rq);  
$conteneur=mysql_fetch_row($rquery);
$date=datefr($conteneur['0']);
$titre=stripslashes($conteneur['1']);
$texte=stripslashes($conteneur['2']);*/

//$role = new Role(NULL,$getid);



echo"<table align='center'>
<caption>Modifier un article </caption>
<form action='modifier_article.php?id=$getid' method='post' name='form1' enctype='multipart/form-data'>
	<tr>
		<td align='right'>
			<font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Titre Article</font>
		</td>
		<td align='left'>
			<input type='text' name='titre' value=\"".$presse->titre."\" size='40' />
		</td>
	</tr>

	<tr>
		<td align='right'>
			<font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Source</font>
		</td>
		<td align='left'>
			<input type='text' name='source' value=\"".$presse->source."\" size='40' />
		</td>
	</tr>

	<tr>
		<td align='right'>
			<font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Auteur</font>
		</td>
		<td align='left'>
			<input type='text' name='auteur' value=\"".$presse->auteur."\" size='40' />
		</td>
	</tr>
	
	<tr>
		<td align='right'>
			<font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Lien</font>
		</td>
		<td align='left'>
			<input type='text' name='lien' value=\"".$presse->lien."\" size='40' />
		</td>
	</tr>
	
	<tr>
		<td align='right'>
			<font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Date Parution</font>
		</td>
		<td align='left'>	
			<input type='text' name='dateParution' id='datePick' value=\"".$presse->dateParution."\" size='40' />
		</td>
	</tr>

	<tr>
				<td class='label'>
					<span>Changer l'article</span>
				</td>
				<td>
					<input type='file' name='fichierArticle' value='' placeholder='Placer le fichier ici'/>
				</td>
	</tr>
	
	<tr>
		<td>
		</td>
		<td align='left'>
		<input type='submit' name='valider' value='modifier' /> 
		</td>
	</tr>







</form>  
</table>";
echo '
	<script>$("#date_debut").datepicker({dateFormat : "yy-mm-dd"});</script>';

}
?>

<?php
include('footer.php');
?>