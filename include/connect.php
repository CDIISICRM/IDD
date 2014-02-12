<?php
	$mysqli = new mysqli("mysql51-113.perso", "mcdaassomag", "B82mhsp7", "mcdaassomag");

	if ($mysqli->connect_errno) {
    	echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>