<?php
require_once('header.php');
include('modele/Modele.Projet.php');
;

$mysqli = Connect::getInstance();
$projet = Projet::chercher($mysqli, $_GET['id']);
$projet->supprimer($mysqli);

echo "<center><strong>Le projet à bien été supprimer.</strong></center>";
echo '<meta http-equiv="refresh" content="2;URL=listprojet.php">';
        
include('footer.php');
?>        
