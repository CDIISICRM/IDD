<?php

include ("modele/Modele.DAO.php");
require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Personne.php');
require_once('modele/Modele.Role.php');
?>



<?php
$mysqli = Connect::getInstance();

$lesRoles = Role::listerTout($mysqli);
	
/*$rq="select date,titre,texte from evenements where id=".$_GET['id'];											
$rquery=@mysql_db_query($base,$rq);  
$conteneur=mysql_fetch_row($rquery);
$date=datefr($conteneur['0']);
$titre=stripslashes($conteneur['1']);
$texte=stripslashes($conteneur['2']);*/

$options = '';
foreach($lesRoles as $unRole)
	{
	
	$options .= '<option value="'.$unRole->getId().'" >'.$unRole->getNomRole().'</option>';
	}


echo"<table align='center'>
<caption>Ajouter un membre </caption>
<form action='ajouter_membre.php' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>NOM</font></td>
<td align='left'>
<input type='text' name='nom' size='40' />

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>Pr&eacute;nom</font></td>
<td align='left'>
<input type='text' name='prenom' size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>email</font></td>
<td align='left'>
<input type='text' name='email' size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>M&eacute;tier</font></td>
<td align='left'>
<input type='text' name='metier' size='40' />
</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>ROLE</font></td>
<td align='left'>
<select name=\"idRole\" id=\"idRole\">
	".$options."
</select>
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
	$personne=new Personne($_POST['nom'],$_POST['prenom'],$_POST['metier'],$_POST['email'],$_POST['idRole']);
	$personne->ajouter($mysqli);
	echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
	
}

?>

<?php
include('footer.php');
?>