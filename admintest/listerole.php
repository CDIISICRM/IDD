<?php 

include ('modele/Modele.DAO.php');
require_once('header.php');
include ("modele/Modele.Role.php");
include("../include/connect.php");


$connection = Connect::getInstance();
$array = Role::listerTout($connection);

/*$partenaire= new Partenaire(NULL,NULL,NULL,NULL);

$array= $partenaire->listerTout($connection);*/

echo '<table border="1" cellpadding="5" cellspacing="5">';
echo "<tr><td><b>Rôle dans l'association</b></td>
	<td></td></tr>";

for($i=0; $i<count($array);$i++  ){
	echo"<tr> ";
	echo"<td>".$array[$i]->getNomRole()."  </td> ";
	echo'<td> <a href=modifier_role.php?id='.$array[$i]->getId().' target="_self"> modifier </a></td> ';
	echo '<td> <a href=supprimer_role.php?id='.$array[$i]->getId().' target="_self"> supprimer </a></td> ';
	echo"</tr> ";
	}
	
	
	echo"</table> ";



echo'<a href="ajouter_role.php" target="_self"> <input type="button" value="Ajouter un role"></a>';









require_once('footer.php');




?>