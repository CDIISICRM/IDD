<?php
	$mysqli = new mysqli("192.168.1.170:3306", "mcdaassomag", "mcdaassomag", "mcdaassomag");

	if ($mysqli->connect_errno) {
    	echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>