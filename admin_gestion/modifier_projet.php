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
$tailleMaxi = 49000000;
$extensions = array('.gif','.jpg','.png');
$dossier = '../media/';
$dossierAbs = 'media/';

if(isset($_POST['valider']) && !empty($_POST['valider'])
        && isset($_POST['nom_projet']) && !empty($_POST['nom_projet'])
        && isset($_POST['obj_projet']) && !empty($_POST['obj_projet'])
        && isset($_POST['etat_projet']) && !empty($_POST['etat_projet'])
        && isset($_POST['date_debut']) && !empty($_POST['date_debut'])
        && isset($_POST['id_projet']) && !empty($_POST['id_projet'])
        && isset($_POST['partenaires']) && !empty($_POST['partenaires'])
        ){
    $idsDesPartenaires = $_POST['partenaires'];
    var_dump($idsDesPartenaires);
    $listePartenaire = array();
            foreach ($idsDesPartenaires as $id){
                
                $unPartenaire = Partenaire::chercher($connection, $id);
                $listePartenaire[] = $unPartenaire;
            }
    $projetAModifier = new Projet($_POST['nom_projet'], $_POST['obj_projet'], $_POST['etat_projet'], $_POST['date_debut'], NULL, NULL, $_POST['id_projet'], $connection);
    $projetAModifier->setListPartenaire($listPartenaire);

    //TODO A Voir

    if(!empty($_FILES['photo_1']['name'])){
  
        $uploadPhoto1 = new upload($dossier, 'photo_1');
        $uploadPhoto1->cl_extensions = $extensions;
        $uploadPhoto1->cl_taille_maxi = $tailleMaxi;
        $uploadPhoto1->uploadFichier();
        $projetAModifier->setPhoto_1($dossierAbs.$uploadPhoto1->cGetNameFileFinal());
        $photo1 = $projetAModifier->getPhoto_1();
        
    } if (!empty($_FILES['photo_2']['name'])) {
      
        $uploadPhoto2 = new upload($dossier, 'photo_2');
        $uploadPhoto2->cl_extensions = $extensions;
        $uploadPhoto2->cl_taille_maxi = $tailleMaxi;
        $uploadPhoto2->uploadFichier();
        $projetAModifier->setPhoto_2($dossierAbs.$uploadPhoto2->cGetNameFileFinal());
        $photo2 = $projetAModifier->getPhoto_2();
    } if($_FILES['photo_1']['name'] ==''){
 
        $photo1 = $_POST['anciennePhoto1'];

        $projetAModifier->setPhoto_1($photo1);
        
    } if($_FILES['photo_2']['name'] == ''){

        $photo2 = $_POST['anciennePhoto2'];
        
        $projetAModifier->setPhoto_2($photo2);
    }
    // Enregistrement des donneés
   
   
    $projetAModifier->modifier($connection);
    echo '<center><strong>Projet modifié</center></strong>';

   
    } else{
        
        
 
	
	

$projet = Projet::chercher($connection, $idProjet);

$nomProjet = $projet->getPNom();
$objectifProjet = $projet->getPObjectifs();
$etatProjet = $projet->getEtatActuel();
$dateDebut = $projet->getDateDeb();
$photo1 = $projet->getPhoto_1();
$photo2 = $projet->getPhoto_2();
$listeMembre = $projet->getListPersonne();
$listePartenaire = $projet->getListPartenaire();
$tousLesPartenaires = Partenaire::listerTout($connection);

        
  

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
                    <tr>
                        <td>Liste des partenaires</td><td>
                            <select name="partenaires" multiple size=5>';
    $selectPartenaires = '';
                                foreach ($tousLesPartenaires as $partenaire){
                                    $selected = '';
                                    foreach ($listePartenaire as $lesPartenaires){
                                        if($lesPartenaires == $partenaire){$selected = 'selected';}
                                    }
                                         $selectPartenaires .= '<option value='.$partenaire->id.' '.$selected.'.>'.$partenaire->nom.'</option>';
                                    
                                };
                                
 $finform =                               '</select></td>
                    </tr>
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
        
	
    
echo $formProjet.$selectPartenaires.$finform;

    }
include('footer.php');
?>
                        