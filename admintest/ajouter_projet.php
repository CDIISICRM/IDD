<?php
include ("modele/Modele.DAO.php");
require_once('header.php');
require_once('../include/connect.php'); 
require_once ('./modele/Modele.Projet.php');
require_once('header.php');
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
            <td>Date de Début : </td><td><input id="datePick" type="datetime" name="dateDebut"></td>
        </tr>
        <tr>
            <td>Photo Projet N°1</td><td><input type="file" name="photoProj1"></td>
        </tr>
        <tr>
            <td>Photo Projet N°2</td><td><input type="file" name="photoProj2"></td>
        </tr>
        <tr>
            <td><input type="submit" name="ajouterProjet"></td><td></td>
        </tr>
    </table>
    <script>$("#datePick").datepicker({dateFormat : "yy-mm-dd"});</script>
</form>





<?php
include('footer.php');

?>