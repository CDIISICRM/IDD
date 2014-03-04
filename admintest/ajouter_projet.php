<?php


require_once('../include/connect.php'); 
require_once ('./modele/Modele.Projet.php');
require_once ('../include/class.upload.php');
require_once('header.php');

if(!empty($_POST['nomProjet']) && !empty($_POST['objectifs']) && !empty($_POST['etatActuel']) && !empty($_POST['dateDebut']) 
        && !empty($_POST['photoProj1']) && !empty($_POST['photoProj2']) && !empty($_POST['ajouterProjet'])){
    echo 'ok';
    $mysqli = Connect::getInstance();
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
    $leProjet->ajouter($mysqli);
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