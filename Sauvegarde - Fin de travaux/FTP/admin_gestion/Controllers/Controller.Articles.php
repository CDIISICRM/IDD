<?php
require_once ('admin_gestion/modele/Modele.Presse.php');
class Articles
{

	public function Presse_info()
	{
		$connection = Connect::getInstance();
		$array = Presse::listerTout($connection);
         echo"<h1>Articles parus</h1>";
		 echo"<div class='afficheArticles'>";
		 for ($i=0;$i<sizeof($array);$i++)
		 {
				echo"
						<h2>".$array[$i]->titre."</h2>";
				if	($array[$i]->source!='')
					echo "<p>".$array[$i]->source;
				if ($array[$i]->auteur!='')
					echo " par ".$array[$i]->auteur;
				if ($array[$i]->dateParution!='')
					echo ", le ".formatDate($array[$i]->dateParution)."</br>";	
				if ($array[$i]->lien!='')
					echo "Lien vers la source : <a target='_blank' href='".$array[$i]->lien."'>".$array[$i]->lien."</a></br>";
				if ($array[$i]->pdf!='')
					echo "Télécharger l'article : <a target='_blank' href='media/".$array[$i]->pdf."'><img src='images/iconepdf.png' alt='téléchargement pdf'></a>";
				echo "</p>";	
				if ($i!=sizeof($array)-1)
					echo"<hr width='100%' align='center'>";
				echo"</br>";
		 }
		 echo"</div>";
		 echo"</br>";
	}
	
}
?>