<?php
include 'modele/Modele.DAO.php';
require_once('header.php');
require_once('../include/connect.php'); 
require_once('../include/class.upload.php');
require_once('modele/Modele.Personne.php');
require_once('modele/Modele.Partenaire.php');
require_once('modele/Modele.Projet.php');

$connection = Connect::getInstance();
if(isset($_GET['id'])){
 $getid=$_GET['id'];
 $idProjet = $_GET['id'];
}  else {
    $idProjet = $_POST['id_projet'];
}

$projet;
$nomProjet;
$objectifProjet;
$etatProjet;
$dateDebut;
$photo1;
$photo2;
$listeMembre;
$listePartenaire;
$projetAModifier;

if(isset($_POST['valider']) && !empty($_POST['valider'])
        && isset($_POST['nom_projet']) && !empty($_POST['nom_projet'])
        && isset($_POST['obj_projet']) && !empty($_POST['obj_projet'])
        && isset($_POST['etat_projet']) && !empty($_POST['etat_projet'])
        && isset($_POST['date_debut']) && !empty($_POST['date_debut'])
        && isset($_POST['id_projet']) && !empty($_POST['id_projet'])){
    
   
    //TODO A Voir
    
    if(!empty($_FILES['photo_1']['name']) && !empty($_FILES['photo_2']['name'])){
        
        $tailleMaxi = 49000000;
        $extensions = array('.gif','.jpg','.png');
        $dossier = '../media/';
        $uploadPhoto1 = new upload($dossier, 'photo_1');
        $uploadPhoto2 = new upload($dossier, 'photo_2');
        $uploadPhoto1->cl_extensions = $extensions;
        $uploadPhoto2->cl_extensions = $extensions;
        $uploadPhoto1->cl_taille_maxi = $tailleMaxi;
        $uploadPhoto2->cl_taille_maxi = $tailleMaxi;
        $uploadPhoto1->uploadFichier();
        $uploadPhoto2->uploadFichier();
    
        $projetAModifier = new Projet($_POST['nom_projet'], $_POST['obj_projet'], $_POST['etat_projet'], $_POST['date_debut'], $uploadPhoto1->cGetNameFileFinal(), $uploadPhoto2->cGetNameFileFinal(), $_POST['id_projet'], $connection);
    }  else {
        
        $photo1 = $_POST['anciennePhoto1'];
        $photo2 = $_POST['anciennePhoto2'];
        
        $projetAModifier = new Projet($_POST['nom_projet'], $_POST['obj_projet'], $_POST['etat_projet'], $_POST['date_debut'], $photo1, $photo2, $_POST['id_projet'], $connection);
    }
    // Enregistrement des donneés
    $formOk = false;
   
    $projetAModifier->modifier($connection);

    $formOk = true;
    // Vérification

    // Enregistre et redirection en cas de succès
//    if($formOk == true)
//            {
//            //MODIF
//            $personne1=new Personne($_POST['nom'],$_POST['prenom'],$_POST['metier'],$_POST['email'],$_POST['idRole'],$getid);
//            $personne1->modifier($connection);
//            echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";
//            echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
//            }
    }
        
 
	
	
//if(empty($formOk) || $formOk == false)
//	{
//	// Affichage du formulaire
//	
//	

            // Si on charge les données la classe Projet (donnée de la BDD)
//		$idProjet = $getid;
            $projet = Projet::chercher($connection, $idProjet);

            $nomProjet = $projet->getPNom();
            $objectifProjet = $projet->getPObjectifs();
            $etatProjet = $projet->getEtatActuel();
            $dateDebut = $projet->getDateDeb();
            $photo1 = $projet->getPhoto_1();
            $photo2 = $projet->getPhoto_2();
            $listeMembre = $projet->getListPersonne();
            $listePartenaire = $projet->getListPartenaire();

        
  

    $formProjet = 
    '
    <form method="POST" action="modifier_projet.php" enctype="multipart/form-data">
            <input type="hidden" name="id_projet" id="id_projet" value="'.$idProjet.'"/>
            <input type="hidden" name="anciennePhoto1" value="'.$photo1.'"/>
            <input type="hidden" name="anciennePhoto2" value="'.$photo2.'"/>
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
                                <textarea  name="obj_projet" id="obj_projet" >'.$objectifProjet.'</textarea>
                            </td>
                    </tr>
                    <tr>
                            <td>&Eacute;tat actuel</td>
                            <td>
                                <textarea  name="etat_projet" id="etat_projet" value="">'.$etatProjet.'</textarea>
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
                                    '.$photo1.' <input type="file" name="photo_1" id="photo_1" />
                            </td>
                    </tr>
                    <tr>
                            <td>Photo 2</td>
                            <td>
                                    '.$photo2.' <input type="file" name="photo_2" id="photo_2" />
                            </td>
                    </tr>
                    <tr>
                            <td colspan="2">
                                    <input type="button" value="Annuler" onClick="Javascript: window.location.href=\'listprojet.php\'"/>&nbsp;&nbsp;&nbsp;<input type="submit" name="valider" value="Valider"/>
            </table>
    </form>
    <script>$("#date_debut").datepicker({dateFormat : "yy-mm-dd"});</script>
    ';
        
	
    
echo $formProjet;

include('footer.php');
?>
                        