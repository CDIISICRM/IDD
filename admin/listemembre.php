<?php 

require_once('header.php');
include 'modele/Modele.DAO.php';
include ("modele/Modele.Personne.php");
// include("../include/connect.php");
include("Modele/Modele.Role.php");

$connection = Connect::getInstance();


//$membre= new Personne(NULL,NULL,NULL,NULL,NULL);

$array= Personne::listerTout($connection);
//$membre->listerTout($connection);
$temp=new Role(null);

echo '<table border="1" cellpadding="5" cellspacing="5">';

	echo"<tr><td><b>Nom</b></td>
	<td><b>Prenom</b></td>
	<td><b>Metier</b></td>
	<td><b>Role</b></td>
	<td></td>
	<td></td></tr>";
	foreach($array AS $key => $personne)
		{
		$leRole = Role::chercher($connection, $personne->idRole);
		echo"<tr> ";
		echo"<td>".$personne->nom."  </td> ";
		echo"<td>".$personne->prenom."  </td> ";
		echo"<td>".$personne->metier."  </td> ";
		
		echo"<td>".$leRole->getNomRole()."  </td> ";
		echo'<td> <a href=modifier_membre.php?id='.$personne->id.' target="_self">  modifier </a></td> ';
		echo'<td> <a href=supprimer_membre.php?id='.$personne->id.' target="_self">  supprimer </a></td> ';
		
		echo"</tr> ";
		}
	
	
	echo"</table> ";


echo'<a href="ajouter_membre.php" target="_self"> <input type="button" value="Ajouter un membre"></a>';


require_once('footer.php');




?>