<?php

require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Partenaire.php');

?>



<?php
$mysqli = Connect::getInstance();

$getid=$_GET['id'];
/*echo"getid=".$getid;*/
if(isset($_POST['valider'] ))
{ 
	$partenaire1=new Partenaire($_POST['nom'],$_POST['site'],$_POST['sygle'],$_POST['logo'],$getid);
	$partenaire1->supprimer($mysqli);
	echo "<center><strong>La suppression a été enregistrée.</strong></center>";
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

$Partenaire = new Partenaire(NULL,NULL,NULL,NULL,$getid);

$Partenaire->chercher($mysqli, $_GET['id']);


echo"<table align='center'>
<caption>Supprimer un Partenaire d'un projet </caption>
<form action='supprimer_partenaire.php?id=$getid' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>NOM</font></td>
<td align='left'>
<input type='text' readonly name='nom' value=\"".$Partenaire->nom."\" size='40' />


<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Site Internet</font></td>
<td align='left'>
<input type='text' readonly name='site' value=\"".$Partenaire->siteInternet."\" size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>SIGLE</font></td>
<td align='left'>
<input type='text' readonly name='sygle' value=\"".$Partenaire->sygle."\" size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>LOGO</font></td>
<td align='left'>
<input type='text' readonly name='logo' value=\"".$Partenaire->logo."\" size='40' />

</td>
</tr>


<tr>
<td>
</td>
<td align='left'>
<input type='submit' name=\"valider\" value='supprimer ?' /> 
</td>
</tr>

</form>  
</table>";

}
?>

<?php
include('footer.php');
?>