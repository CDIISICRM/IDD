<?php 

require_once('../header.php');
include ("../modele/Modele.Personne.php");
include("../../include/connect.php");

$connection = Connect::getInstance();


$membre= new Personne(NULL,NULL,NULL,NULL,NULL);

$array= $membre->listerTout($connection);

echo '<table border="1" cellpadding="5" cellspacing="5">';


for($i=0; $i<count($array);$i++  ){
	echo"<tr> ";
	echo"<td>".$array[$i]->nom."  </td> ";
	echo"<td>".$array[$i]->prenom."  </td> ";
	echo"<td>".$array[$i]->metier."  </td> ";
	echo"</tr> ";
	}
	
	
	echo"</table> ";

require_once('../footer.php');




?>