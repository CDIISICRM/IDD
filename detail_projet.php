<?php
require("include/header_meta.php");
require("include/menu.php");
include("include/banniere.php");
include("include/connect.php");
?>

<?php

	function resize($image){
		
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

		// Sinon si Width final non précisé (0)

		//elseif(!$dst_w) 
		
		
	//$dst_w = $test_w;

		// Sinon teste quel redimensionnement tient dans la zone

		elseif($test_h>$dst_h) 
		
		$dst_w = $test_w;

		else 
		$dst_h = $test_h;	  
		  
		
		$dim=array($dst_w,$dst_h);
		return $dim;
	}



 	$connection = Connect::getInstance();
	
	$projet = 2;
	if(isset($_GET['projet']))
		$projet = $_GET['projet'];
	
	$rq = "SELECT id,nom,objectifs,etatActuel,date_debut,photo_proj1,photo_proj2 FROM projets WHERE id=".$projet;
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
		else {echo " Projet non trouvé ";}
	
	$dimRes1=resize($img1);
	$dimRes2=resize($img2);
	echo ('<div class="">
		  <h1 align="center">'.$nom.'</h1>     
              
              <h3>Objectif: </h3>
			  <p class="projet"><img  class="image" width="'.$dimRes1[0].'" height="'.$dimRes1[1].'"  src="'.$img1.'" alt="projet3" style="float:left" />'.$objectifs .'</p>
              
			  
			  
			  <h3>Date : </h3>
			  <h5>'.formatDate($date).'</h5>
			  
			  <h3>Description de l\'état du projet: </h3>
			  <p class="projet"> 
			  <img  class="image" width="'.$dimRes2[0].'" src="'.$img2.'" alt="projet3" style="float:right" />'.$etatActuel.'</p>
			 
           
          </div>');
		  
		  
		  

		/*  if($name_image != "" )

		{ //$dst_w=0;
		//$dst_h=0;
		// Lit les dimensions de l'image
		$image=$name_image.$extension;
		$taille = GetImageSize("$image"); $src_w = $taille[0]; $src_h = $taille[1];

		if($src_w >= 300 ) 
		{$dst_w = 300;
		$dst_h=false;
		}
		
		 
		else 
		{$dst_w = $src_w;
		
			$dst_h = $src_h;}

		// Teste les dimensions tenant dans la zone

		$test_h = round(($dst_w / $src_w) * $src_h);

		$test_w = round(($dst_h / $src_h) * $src_w);

		// Si Height final non précisé (0)

		if(!$dst_h) 
		$dst_h = $test_h;

		// Sinon si Width final non précisé (0)

		//elseif(!$dst_w) 
		
		
	//$dst_w = $test_w;

		// Sinon teste quel redimensionnement tient dans la zone

		elseif($test_h>$dst_h) 
		
		$dst_w = $test_w;

		else 
		$dst_h = $test_h;
		
		
		
		echo("<img height='$dst_h' width='$dst_w' title='Equipe' src='$image' class='image'/>");
		}*/
		  
	
	
?>







        


<?php 

include("include/news.php");
include("include/footer.php");



?>