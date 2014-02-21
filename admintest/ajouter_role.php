<?php

require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Role.php');

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
<caption>Ajouter un Role d'un projet </caption>
<form action='ajouter_role.php' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Nom du Role</font></td>
<td align='left'>
<input type='text' name='nomRole' size='40' />



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
	$role=new Role($_POST['nomRole']);
	$role->ajouter($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listerole.php">';
	
}

?>

<?php
include('./footer.php');
?>