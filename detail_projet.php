<?php
require_once("include/header_meta.php");
require_once("include/menu.php");
require_once("include/connect.php");
require_once("include/banniere.php");

function resize($image)
	{
	$taille = GetImageSize("$image"); 
	$src_w = $taille[0]; 
	$src_h = $taille[1];

	if($src_w >= 400 ) 
		{
		$dst_w = 400;
		$dst_h=false;
		}
	else 
		{
		$dst_w = $src_w;
		$dst_h = $src_h;
		}

	// Teste les dimensions tenant dans la zone

	$test_h = round(($dst_w / $src_w) * $src_h);
	$test_w = round(($dst_h / $src_h) * $src_w);

	// Si Height final non précisé (0)

	if(!$dst_h) 
		$dst_h = $test_h;
	elseif($test_h>$dst_h) 
		$dst_w = $test_w;
	else 
		$dst_h = $test_h;	  
	  
	$dim=array($dst_w,$dst_h);
	
	return $dim;
	}

$connection = Connect::getInstance();

$projet = '';
if(isset($_GET['projet']))
	$projet = $_GET['projet'];

$rq = 'SELECT id,nom,objectifs,etatActuel,date_debut,photo_proj1,photo_proj2 FROM projets WHERE id='.$projet;

$res=$connection->query($rq); 
$tab=$res->fetch_array();	

if ($tab != null)
	{
	$date=stripslashes($tab['date_debut']);
	$nom=stripslashes($tab['nom']);
	$objectifs=stripslashes($tab['objectifs']);
	$etatActuel=stripslashes($tab['etatActuel']);		
	$etatActuel= preg_replace("((\r\n)|(\n)|(\r))","<br/>",$etatActuel);
	$objectifs= preg_replace("((\r\n)|(\n)|(\r))","<br/>",$objectifs);
	$img1= $tab['photo_proj1'];
	$img2= $tab['photo_proj2'];
	}
else 
	{
	echo " Projet non trouvé ";
	}

$dimRes1=resize($img1);
$dimRes2=resize($img2);
echo ('
<div class="projetContainer">
	<h1 align="center">'.$nom.'</h1>
	<div style="min-height:'.intval($dimRes1[1]+11).'px;">     
		<img class="image projetImg1" width="'.$dimRes1[0].'" height="'.$dimRes1[1].'"  src="'.$img1.'" alt="Photo 1 du projet '.$nom.'" />
		<h2>Objectif: </h2>
		<p>'.$objectifs .'</p>
	</div>
	<div>  
	  <img class="image projetImg2" width="'.$dimRes2[0].'" height="'.$dimRes2[1].'" src="'.$img2.'" alt="Photo 2 du projet '.$nom.'" />
	  <h2>Date : </h2>
	  <p>'.formatDate($date).'</p>
	  <h2>Description de l\'état du projet: </h2>
	  <p>'.$etatActuel.'</p>
	</div>
</div>');

require_once("include/footer.php");
?>