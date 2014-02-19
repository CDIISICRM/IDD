<?php

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


	



}
else
{
	echo 'I am here!';
	
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
echo"<table align='center'>
<caption>Modifier un Membre de l'association </caption>
<form action='modifier_membre.php?id=$getid' method='post' name='form1' enctype='multipart/form-data'>
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
<input type='text' name='prenom' value=\"".$personne->metier."\" size='40' />

</td>
</tr>



<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>EMAIL</font></td>
<td align='left'>
<input type='text' name='prenom' value=\"".$personne->email."\" size='40' />

</td>
</tr>

<tr>
<td align='right'><font color='#663300' face='Arial, Helvetica, sans-serif' size='+1'>ROLE</font></td>
<td align='left'>
<select name=\"idRole\" id=\"idRole\">";

foreach($lesRoles as $unRole){
	
	if(intval($unRole->getId()) == intval($personne->idRole))
		
		{
			echo '<option value="'.$unRole->getId().'" selected >'.$unRole->getNomRole().'</option>';
	
		}
	else
		{
			echo '<option value="'.$unRole->getId().'" >'.$unRole->getNomRole().'</option>';
		}
	
}
echo"
</select>

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