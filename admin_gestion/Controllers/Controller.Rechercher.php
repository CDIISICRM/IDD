<?php
class Rechercher
	{
// controller=Projet&action=AfficherTousProjets&page=1&pagination=5

	public function RechercherProjet()
		{
		$motCle = $_POST['keyword'];
		$connection = Connect::getInstance();

		$req = "
		SELECT 
			id, nom 
		FROM 
			projets
		WHERE 
			nom LIKE '%".$motCle."%' OR 
			nom LIKE '".$motCle."' OR 
			objectifs LIKE '%".$motCle."%' OR 
			objectifs LIKE '".$motCle."' OR 
			etatActuel LIKE '%".$motCle."%' OR 
			etatActuel LIKE '".$motCle."' ";
			
		
		$titreResultat = '<h1>Résultat de votre recherche</h1>';
		$resultat = '<li>Il n\'y a pas de résultat à votre rechercher</li>';
		$query = $connection->query($req);
		if($query->num_rows > 0)
			{
			$titreResultat .= '<p>Il y a '.$query->num_rows.' réponse(s) pour votre rechercher.</p>';
			$resultat = '';
			while($data = $query->fetch_array())
				$resultat .= '
				<li>
					<a href="index.php?controller=ControlleurProjet&action=DetailProjet&projet='.$data[0].'">'.$data[1].'</a>
				</li>';
			}
			
			
			/*
		nom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
		  `objectifs` text CHARACTER SET utf8,
		  `etatActuel
		*/
		
		require_once('Views/rechercher/resultat_rechercher.view.php');
		}
	
	}
?>