<?php

require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Partenaire.php');
require("../include/class_upload.php");
?>



<?php
$mysqli = Connect::getInstance();

	
/*$rq="select date,titre,texte from evenements where id=".$_GET['id'];											
$rquery=@mysql_db_query($base,$rq);  
$conteneur=mysql_fetch_row($rquery);
$date=datefr($conteneur['0']);
$titre=stripslashes($conteneur['1']);
$texte=stripslashes($conteneur['2']);*/




echo"<table align='center'>
<caption>Ajouter un Partenaire d'un projet </caption>
<form action='ajouter_partenaire.php' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>NOM</font></td>
<td align='left'>
<input type='text' name='nom' size='40' />


<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Site Internet</font></td>
<td align='left'>
<input type='text' name='site' size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>SIGLE</font></td>
<td align='left'>
<input type='text' name='sygle' size='40' />

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
<input type='submit' name=\"valider\" value='ajouter' /> 
</td>
</tr>

</form>  
</table>";

if (isset($_POST['valider']))
{
	//var_dump($_POST);
	//var_dump($_POST['fichierLogo']);
	$obj = new upload('../images/','fichierLogo');
	$obj->cl_taille_maxi = 49000000;
	$obj->cl_extensions = array('.gif','.jpg','.png');
	if (!$obj->uploadFichier())
	 {
			// affichage d'une erreur en cas d'echec
			echo $obj->affichageErreur();
	 }
	 else
	 {
		$partenaire=new Partenaire($_POST['nom'],$_POST['site'],$obj->cGetNameFile(true),$_POST['sygle']);
		$partenaire->ajouter($mysqli);
		echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
		echo '<meta http-equiv="refresh" content="12;URL=listepartenaire.php">';
	 }
	
	
	//Tentatvie d'upload à la main
	
	/*$target_path = "../images/";

	//$target_path = $target_path . basename( $_FILES['fichierLogo']['name']);
	$target_path = $target_path .'imgTest.jpg'; 
	//var_dump($_FILES['fichierLogo']);
	if(move_uploaded_file($_FILES['fichierLogo']['tmp_name'], $target_path)) {
    	echo "The file ".  basename( $_FILES['fichierLogo']['name']). 
    	" has been uploaded";
	} 
	else{
    		echo "There was an error uploading the file, please try again!";
		}*/

	
	
}

?>

<?php
include('footer.php');
?>