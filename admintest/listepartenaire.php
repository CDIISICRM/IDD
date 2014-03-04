<?php 

require_once('header.php');
include ("modele/Modele.Partenaire.php");
// include("../include/connect.php");


$connection = Connect::getInstance();
$array = Partenaire::listerTout($connection);

/*$partenaire= new Partenaire(NULL,NULL,NULL,NULL);

$array= $partenaire->listerTout($connection);*/

echo '<table border="1" cellpadding="5" cellspacing="5">';
echo"<tr>
	<td><b>Nom</b></td>
	<td><b>Site internet</b></td>
	<td></td>
	<td></td>
	</tr>";

for($i=0; $i<count($array);$i++  ){
	echo"<tr> ";
	echo"<td>".$array[$i]->nom."  </td> ";
	echo"<td>".$array[$i]->siteInternet."  </td> ";
	echo'<td> <a href=modifier_partenaire.php?id='.$array[$i]->id.' target="_self">  modifier </a></td> ';
	echo'<td> <a href=supprimer_partenaire.php?id='.$array[$i]->id.' target="_self">  supprimer </a></td> ';
	echo"</tr> ";
	}
	
	
	echo"</table> ";



echo'<a href="ajouter_partenaire.php" target="_self"> <input type="button" value="Ajouter un partenaire"></a>';









require_once('footer.php');




?>