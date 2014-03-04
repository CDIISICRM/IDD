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

	echo "<h1>".stripslashes($table["titre"])."</h1>";

	echo '<div class="section"><p style="text-align:justify" ><img src='.$img.' alt="action association" style="float: left; border: 0; margin-right:10px ; margin-bottom:10px" \>'.stripslashes($table["texte"]).'</p></div>';
		
		include("include/news.php");
		//include("include/footer.php");
	}
	
}
?>