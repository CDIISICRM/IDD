<?php

require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Partenaire.php');
require("../include/class_upload.php");
?>



<?php
$mysqli = Connect::getInstance();

$getid=$_GET['id'];
$Partenaire = new Partenaire(NULL,NULL,NULL,NULL,$getid);

$Partenaire->chercher($mysqli, $_GET['id']);
/*echo"getid=".$getid;*/
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
			unlink('../images/'.$oldLogo);
			$partenaire=new Partenaire($_POST['nom'],$_POST['site'],$obj->cGetNameFileFinal(true),$_POST['sygle'],$_GET['id']);
	   }
	}
	 else//on conserve l'ancien logo
	 {
		 $partenaire=new Partenaire($_POST['nom'],$_POST['site'],$oldLogo,$_POST['sygle'],$_GET['id']);
	 }
	 
	$partenaire->modifier($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listepartenaire.php">'; 
	
}
else
{

	
/*$rq="select date,titre,texte from evenements where id=".$_GET['id'];											
$rquery=@mysql_db_query($base,$rq);  
$conteneur=mysql_fetch_row($rquery);
$date=datefr($conteneur['0']);
$titre=stripslashes($conteneur['1']);
$texte=stripslashes($conteneur['2']);*/




echo"<table align='center'>
<caption>Modifier un Partenaire d'un projet </caption>
<form action='modifier_partenaire.php?id=$getid' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>NOM</font></td>
<td align='left'>
<input type='text' name='nom' value=\"".$Partenaire->nom."\" size='40' />


<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Site Internet</font></td>
<td align='left'>
<input type='text' name='site' value=\"".$Partenaire->siteInternet."\" size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>SIGLE</font></td>
<td align='left'>
<input type='text' name='sygle' value=\"".$Partenaire->sygle."\" size='40' />
 
</td>
</tr>

<tr>
	  <td align='right'>
		<font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Telecharger le logo
	  </td>
	  <td align='left'>
		  <input type='file' name='fichierLogo' value='' placeholder='Placer le fichier ici'/>
	  </td>
</tr>


<tr>
<td>
</td>
<td align='left'>
<input type='submit' name=\"valider\" value='modifier' /> 
</td>
</tr>

</form>  
</table>";

}
?>

<?php
include('footer.php');
?>