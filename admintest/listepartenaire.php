<?php 

require_once('header.php');
include ("modele/Modele.Partenaire.php");
include("../include/connect.php");

$connection = Connect::getInstance();


$partenaire= new Partenaire(NULL,NULL,NULL,NULL);

$array= $partenaire->listerTout($connection);

echo '<table border="1" cellpadding="5" cellspacing="5">';


for($i=0; $i<count($array);$i++  ){
	echo"<tr> ";
	echo"<td>".$array[$i]->nom."  </td> ";
	echo"<td>".$array[$i]->siteInternet."  </td> ";
	echo'<td> <a href=modifier_partenaire.php?id='.$array[$i]->id.' target="_self">  modifier </a></td> ';
	
	echo"</tr> ";
	}
	
	
	echo"</table> ";

require_once('footer.php');




?>