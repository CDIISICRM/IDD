<?php

class index
{

	public function afficher_index()
	{
		//echo'Vous êtes sur la page index.';
		$connection = Connect::getInstance();
	$req = "SELECT titre, texte, img, extension FROM contenus WHERE id=1";
	$res = $connection->query($req); 
	$table = $res->fetch_assoc();
	$img = $table["img"].'.'.$table["extension"];
	$texte=stripslashes($table["texte"]);
	/*$texte= preg_replace("(\n)","<br/>",$texte);	*/
	$taille =array();
					$taille=getimagesize($img);
					$hauteurR=$taille[0];
					$largeurR=$taille[1];
					$cte=300;
					$nouvelle_largeur=$cte;
					$nouvelle_hauteur=$cte*($largeurR/$hauteurR);

	echo "<h1>".stripslashes($table["titre"])."</h1>";

	echo '<div class="section"><p style="text-align:justify" ><img src='.$img.' alt="action association" width="'.$nouvelle_largeur.'" height="'.$nouvelle_hauteur.'" style="float: left; margin-right:20px ; margin-bottom:20px" class="image" \>'.$texte.'</p></div>';
		
		include("include/news.php");
		//include("include/footer.php");
	}
	
}
?>