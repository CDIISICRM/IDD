<?php

include 'modele/Modele.DAO.php';
require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Personne.php');
require_once('modele/Modele.Role.php');
?>



<?php
$mysqli = Connect::getInstance();

	
			
$getid=$_GET['id'];
/*echo"getid=".$getid;*/
if(isset($_POST['valider'] ))
{ 
	$personne1=new Personne($_POST['nom'],$_POST['prenom'],$_POST['metier'],$_POST['email'],$_POST['idRole'],$getid);
	$personne1->supprimer($mysqli);
	echo "<center><strong>La suppression a bien été enregistrée.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
}
else
{	
/*$rq="select date,titre,texte from evenements where id=".$_GET['id'];											
$rquery=@mysql_db_query($base,$rq);  
$conteneur=mysql_fetch_row($rquery);
$date=datefr($conteneur['0']);
$titre=stripslashes($conteneur['1']);
$texte=stripslashes($conteneur['2']);*/

$personne = new Personne(NULL,NULL,NULL,NULL,NULL, 0);
$personne->chercher($mysqli, $_GET['id']);

$leRole = new Role(NULL,NULL);
$lesRoles = $leRole->listerTout($mysqli);

$options = '';
foreach($lesRoles as $unRole)
	{
	$selected = '';
	//echo $personne->idRole.'<br/>';
	if($unRole->getId() == $personne->idRole)
		{
		//echo $unRole->getId().' VS '.$personne->idRole.'<br/>';
		$selected = ' selected="selected"';
		}
	$options .= '<option value="'.$unRole->getId().'"'.$selected.' >'.$unRole->getNomRole().'</option>';
	}


echo"<table align='center'>
<caption>Supprimer un Membre de l'association </caption>
<form action='supprimer_membre.php?id=$getid' method='post' name='form1' enctype='multipart/form-data'>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>NOM</font></td>
<td align='left'>
<input type='text' name='nom' value=\"".$personne->nom."\" size='40' />

</td>
</tr>
<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>PRENOM</font></td>
<td align='left'>
<input type='text' name='prenom' value=\"".$personne->prenom."\" size='40' />

</td>
</tr>


<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>METIER</font></td>
<td align='left'>
<input type='text' name='metier' value=\"".$personne->metier."\" size='40' />

</td>
</tr>



<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>EMAIL</font></td>
<td align='left'>
<input type='text' name='email' value=\"".$personne->email."\" size='40' />

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