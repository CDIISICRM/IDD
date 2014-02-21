<?php

include ('modele/Modele.DAO.php');
require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Role.php');

?>



<?php
$mysqli = Connect::getInstance();

$getid=$_GET['id'];
/*echo"getid=".$getid;*/
if(isset($_POST['valider'] ))
{ 
	$role1=new Role($_POST['nomRole'],$getid);
	$role1->supprimer($mysqli);
	echo "<center><strong>La suppression a bien été enregistrée.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listerole.php">';
}
else
{

	
/*$rq="select date,titre,texte from evenements where id=".$_GET['id'];											
$rquery=@mysql_db_query($base,$rq);  
$conteneur=mysql_fetch_row($rquery);
$date=datefr($conteneur['0']);
$titre=stripslashes($conteneur['1']);
$texte=stripslashes($conteneur['2']);*/

$role = new Role(NULL,$getid);

$role->chercher($mysqli, $_GET['id']);


echo"<table align='center'>
<caption>Supprimer un Role</caption>
<form action='supprimer_role.php?id=$getid' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>NOM</font></td>
<td align='left'>
<input type='text' name='nomRole' value=\"".$role->getNomRole()."\" size='40' />


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