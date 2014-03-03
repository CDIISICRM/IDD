<?php
include 'modele/Modele.DAO.php';
require_once('header.php');
require_once('../include/connect.php'); 
require_once('modele/Modele.Personne.php');
require_once('modele/Modele.Partenaire.php');
require_once('modele/Modele.Projet.php');

$connection = Connect::getInstance();
$getid=$_GET['id'];

if(isset($_POST['valider'] ))
	{
	// Enregistrement des donneés
	$formOk = false;
	// Vérification
	
	// Enregistre et redirection en cas de succès
	if($formOk == true)
		{
		//MODIF
		$personne1=new Personne($_POST['nom'],$_POST['prenom'],$_POST['metier'],$_POST['email'],$_POST['idRole'],$getid);
		$personne1->modifier($connection);
		echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
		echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
		}
	}
	
	
if(empty($formOk) || $formOk == false)
	{
	// Affichage du formulaire
	$listeMembre = Personne::listerTout($connection);
	$listePartenaire = Partenaire::listerTout($connection);
	
	// Générer les champs du formulaire
	if(empty($formOk))
		{
		// Si on charge les données la classe Projet (donnée de la BDD)
		$idProjet = $getid;
		$projet = new Projet(NULL,NULL,NULL,NULL,NULL, NULL, NULL, NULL, $idProjet);
		
		$nomProjet = $projet->getPNom();
		$objectifProjet = $projet->getPObjectifs();
		$etatProjet = $projet->getEtatActuel();
		$dateDebut = $projet->getDateDeb();
		$photo1 = $projet->getPhoto_1();
		$photo2 = $projet->getPhoto_2();
		}
	else
		{
		// S'il y a eu une erreur de saisie
		$idProjet = $_POST['id_projet'];
		$projet = new Projet(NULL,NULL,NULL,NULL,NULL, NULL, NULL, NULL, $idProjet);
		
		$nomProjet = $_POST['nom_projet'];
		$objectifProjet = $_POST['obj_projet'];
		$etatProjet = $_POST['etat_projet'];
		$dateDebut = $_POST['date_debut'];
		$photo1 = $projet->photo1;
		$photo2 = $projet->photo2;
		}
	
	$formProjet = 
	'
	<form method="POST" action="modifier_projet.php" enctype="multipart/form-data">
		<input type="hidden" name="id_projet" id="id_projet" value="'.$idProjet.'"/>
		<table>
			<tr>
				<td>Nom du projet</td>
				<td>
					<input type="text" name="nom_projet" id="nom_projet" value="'.$nomProjet.'"/>
				</td>
			</tr>
			<tr>
				<td>Objectif(s)</td>
				<td>
					<input type="text" name="obj_projet" id="obj_projet" value="'.$objectifProjet.'"/>
				</td>
			</tr>
			<tr>
				<td>&Eactue;tat actuel</td>
				<td>
					<input type="text" name="etat_projet" id="etat_projet" value="'.$etatProjet.'"/>
				</td>
			</tr>
			<tr>
				<td>Date de début</td>
				<td>
					<input type="text" name="date_debut" id="date_debut" value="'.$dateDebut.'"/>
				</td>
			</tr>
			<tr>
				<td>Photo 1</td>
				<td>
					'.$photo1.' <input type="file" name="photo_1" id="photo_1" value="'.$photo1.'"/>
				</td>
			</tr>
			<tr>
				<td>Photo 2</td>
				<td>
					'.$photo2.' <input type="file" name="photo_2" id="photo_2" value="'.$photo2.'"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="button" value="Annuler" onClick="Javascript: window.location.href=\'listprojet.php\'"/>&nbsp;&nbsp;&nbsp;<input type="submit" name="valider" value="Valider"/>
		</table>
	</form>
	';
	}

echo $formProjet;
include('footer.php');
?>