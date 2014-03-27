<?php
require_once('header.php');
include('modele/Modele.Projet.php');

$connection=Connect::getInstance();
    

   $listeProjet = Projet::listerTout($connection);
    
	
    $tableProjet = '<table border="1" cellpadding="5" cellspacing="5">
	<tr>
		<th>Nom du projet</th>
		<th>Objectifs</th>
		<th>&Eacute;tat actuel</th>
		<th>Date de début</th>
		<th>Photo 1</th>
		<th>Photo 2</th>
		<th>Edition</th>
		<th>Suppression</th>
	</tr>
	';

	for($i=0; $i<count($listeProjet);$i++)
		{
		// Coupé les chaine trop longue (> 100 carac)
		$objectif = substr($listeProjet[$i]->getPObjectifs(), 0, 100);
		$etatActuel = substr($listeProjet[$i]->getetatActuel(), 0, 100);
		
		$photo1 = "&nbsp;";
		if($listeProjet[$i]->getPhoto_1() != '')
			$photo1 = $listeProjet[$i]->getPhoto_1();
			
		$photo2 = "&nbsp;";
		if($listeProjet[$i]->getPhoto_2() != '')
			$photo2 = $listeProjet[$i]->getPhoto_2();
		
		$tableProjet .= '<tr>';
		$tableProjet .= '<td> '.$listeProjet[$i]->getPNom().'</td>
				<td> ' .$objectif. ' ...</td>
				<td> ' .$etatActuel. ' ...</td>
				<td> ' .$listeProjet[$i]->getDateDeb(). ' </td>
				<td> ' .$photo1. ' </td>
				<td> ' .$photo2. ' </td>
				<td>
					<a href="modifier_projet.php?id='.$listeProjet[$i]->getId().'">Modifier</a>
				</td>
				<td>
					<a href="supprimer_projet.php?id='.$listeProjet[$i]->getId().'">Supprimer</a>
				</td>';
		$tableProjet .= '</tr>';
		}
	$tableProjet .= '</table>
	<input type="button" value="Ajouter" onClick="Javascript: window.location.href=\'ajouter_projet.php\'"/>';
            
    echo $tableProjet;
    include('footer.php');       
?>