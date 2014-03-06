<?php
require_once('header.php');
include('modele/Modele.Projet.php');
;

$mysqli = Connect::getInstance();
$projet = Projet::chercher($mysqli, $_GET['id']);
$projet->supprimer($mysqli);

echo 'Projet supprimé';
        
include('footer.php');
?>        
