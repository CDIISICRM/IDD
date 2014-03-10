<?php 

include ('modele/Modele.DAO.php');
require_once('header.php');
include ("modele/Modele.Presse.php");
// include("../include/connect.php");


$connection = Connect::getInstance();
$array = Presse::listerTout($connection);

/*$partenaire= new Partenaire(NULL,NULL,NULL,NULL);

$array= $partenaire->listerTout($connection);*/
// var_dump($array);
if($array)
	{
	echo '<table border="1" cellpadding="5" cellspacing="5">';
	echo "<tr><td><b>Titre</b></td>
			<td><b>Source</b></td>
			<td><b>Auteur</b></td>
			<td><b>Lien</b></td>
			<td><b>pdf</b></td>
			<td><b>Date Parution</b></td>
	<td></td></tr>";
	for($i=0; $i<count($array);$i++  ){
		echo"<tr> ";
		echo"<td>".$array[$i]->titre."  </td> ";
		echo"<td>".$array[$i]->source."  </td> ";
		echo"<td>".$array[$i]->auteur."  </td> ";
		echo"<td>".$array[$i]->lien."  </td> ";
		echo"<td>".$array[$i]->pdf."</td>";
		echo"<td>".$array[$i]->dateParution."  </td> ";

		echo'<td> <a href=modifier_article.php?id='.$array[$i]->id.' target="_self">  modifier </a></td> ';
		echo'<td> <a href=supprimer_article.php?id='.$array[$i]->id.' target="_self">  supprimer </a></td> ';
		echo"</tr> ";
		}
		
		
		echo"</table> ";
	}
else
	echo '<center><p>Il n\'y a pas d\'article pour le moment</p></center>';



echo'<a href="ajouter_article.php" target="_self"> <input type="button" value="Ajouter un article"></a>';









require_once('footer.php');




?>