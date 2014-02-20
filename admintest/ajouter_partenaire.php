<?php

require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Partenaire.php');

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
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>LOGO</font></td>
<td align='left'>
<input type='text' name='logo' size='40' />

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
	$partenaire=new Partenaire($_POST['nom'],$_POST['site'],$_POST['sygle'],$_POST['logo']);
	$partenaire->ajouter($mysqli);
	echo "ajouté";
	
}

?>

<?php
include('footer.php');
?>