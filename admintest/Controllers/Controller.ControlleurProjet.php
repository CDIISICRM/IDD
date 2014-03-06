<?php
require_once ('admintest/modele/Modele.Projet.php');
class ControlleurProjet
{
// controller=Projet&action=AfficherTousProjets&page=1&pagination=5

	public function AfficherTousProjets($id,$page=1,$pagination=5)
		{
		$contenu="";
		$connection = Connect::getInstance();

		$tableau = Projet::listerAlea($connection);

		$nompreItems = $_GET['pagination'];


		if(count($tableau) % $nompreItems != 0)
			{
			$nombreDePages = floor(count($tableau) / $nompreItems) +1;
			}
		else
			{
			$nombreDePages = floor(count($tableau) / $nompreItems);
			}

		$pagination ='';
		for($j=1 ; $j<=$nombreDePages; $j++)
			{
			$pagination .='<a href="index.php?controller=ControlleurProjet&action=AfficherTousProjets&page='.$j.'&pagination='.$nompreItems.'">| Page '.$j.' |</a>';	
			}
		
		$pageCourante = $_GET['page'];
		$accordion ='';
		for($i=($pageCourante -1)*$nompreItems; $i<=($pageCourante * $nompreItems -1);$i++)
			{
			if(@$tableau[$i][0] != "" || @$tableau[$i][0] != NULL)
				{
				$accordion .='<h3 style="padding-left:30px">'.$tableau[$i][1].'</h3>';
				$accordion .= '<div>
					<p class="demoHeaders">'.$tableau[$i][2]. '</p>
					<br />
					<a href="index.php?controller=ControlleurProjet&action=DetailProjet&projet='.$tableau[$i][0].'" ><i>Pour en savoir plus</i></a>
					<br/>
					</div>';
				}
		}
			
		require_once('Views/projet/afficher_tous_projets.view.php');		
		}
	
	public function DetailProjet($id)
	{
	
	
	



$connection = Connect::getInstance();
$contenu = '';
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
	$contenu.='<p>Projet non trouvé</p>';
	}

$photo1 = '';
$photo2 = '';
$specialSize = '';


if(is_file($img1))
	{
			$dimRes1=$this->resize($img1);
			$photo1 = '<img class="image projetImg1" width="'.$dimRes1[0].'" height="'.$dimRes1[1].'"  src="'.$img1.'" alt="Photo 1 du projet '.$nom.'" />';
			$specialSize = ' style="min-height:'.intval($dimRes1[1]+11).'px;"';
			}
			
		if(is_file($img1))
			{
			$dimRes2=$this->resize($img2);
			$photo2 = '<img class="image projetImg2" width="'.$dimRes2[0].'" height="'.$dimRes2[1].'" src="'.$img2.'" alt="Photo 2 du projet '.$nom.'" />';
			}
			
			
		require_once('Views/projet/detail_projet.view.php');
		
	
	}
	
	public function resize($image)
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
	
	

}
?>