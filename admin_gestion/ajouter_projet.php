<?php


require_once('../include/connect.php'); 
require_once ('./modele/Modele.Projet.php');
require_once ('../include/class.upload.php');
require_once('header.php');

$mysqli = Connect::getInstance();
$tousLesPartenaires = Partenaire::listerTout($mysqli);


if(!empty($_POST['nomProjet']) && !empty($_POST['objectifs']) && !empty($_POST['etatActuel']) && !empty($_POST['dateDebut']) 
        && !empty($_FILES['photoProj1']['name']) && !empty($_FILES['photoProj2']['name']) && $_FILES['photoProj1']['name'] != '' 
        && $_FILES['photoProj2']['name'] != '' && !empty($_POST['ajouterProjet']) 
        && !empty($_POST['ajouterProjet'])  && $_POST['ajouterProjet'] != ''){

    var_dump($_FILES['photoProj1']);
    $tailleMaxi = 49000000;
    $extensions = array('.gif','.jpg','.png');
    $dossier = '../media/';
    $uploadPhoto1 = new upload($dossier, 'photoProj1');
    $uploadPhoto2 = new upload($dossier, 'photoProj2');
    $uploadPhoto1->cl_extensions = $extensions;
    $uploadPhoto2->cl_extensions = $extensions;
    $uploadPhoto1->cl_taille_maxi = $tailleMaxi;
    $uploadPhoto2->cl_taille_maxi = $tailleMaxi;
    $uploadPhoto1->uploadFichier();
    $uploadPhoto2->uploadFichier();
    $leProjet = new Projet($_POST['nomProjet'],
            $_POST['objectifs'], 
            $_POST['etatActuel'], 
            $_POST['dateDebut'],
            'media/'.$uploadPhoto1->cGetNameFileFinal(), 
            'media/'.$uploadPhoto2->cGetNameFileFinal());
    $lesPartenairesDuProjet = NULL;
    foreach ($_POST['partenaires'] as $idPartenaire){
        $unPartenaire = Partenaire::chercher($mysqli, $idPartenaire);
        $lesPartenairesDuProjet[] = $unPartenaire;
    }
    $leProjet->setListPartenaire($lesPartenairesDuProjet);
    $leProjet->ajouter($mysqli);

    echo 'Projet ajouté';

}
?>
<form method="post" enctype="multipart/form-data" action="ajouter_projet.php">
    <table>
        <tr>
            <td>Nom Projet : </td><td><input type="text" name="nomProjet"></td>
        </tr>
        <tr>
            <td>Objectifs : </td><td><textarea name="objectifs"></textarea></td>
        </tr>
        <tr>
            <td>Etat Actuel : </td><td><textarea name="etatActuel"></textarea></td>
        </tr>
        <tr>
            <td>Date de Début : </td><td><input id="datePick" type="text" name="dateDebut"></td>
        </tr>
        <td>Liste des partenaires</td><td>
                            <select name="partenaires[]" multiple size=5>
   <?php
                                foreach ($tousLesPartenaires as $partenaire){
                                   
                                         echo '<option value='.$partenaire->id.' >'.$partenaire->nom.'</option>';
                                    
                                };
 ?>
                              </select></td>
        <tr>
            <td>Photo Projet N°1</td><td><input type="file" name="photoProj1"></td>
        </tr>
        <tr>
            <td>Photo Projet N°2</td><td><input type="file" name="photoProj2"></td>
        </tr>
        <tr>
            <td><input type="submit" name="ajouterProjet" value="Ajouter"></td><td></td>
        </tr>
    </table>
    <script>$("#datePick").datepicker({dateFormat : "yy-mm-dd"});</script>
</form>





<?php
include('footer.php');

?>