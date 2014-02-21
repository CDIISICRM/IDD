<?php
//include début de page par Michel
require("include/header_meta.php");
require("include/menu.php");
require_once './admintest/modele/Modele.Travaille.php';
include("include/banniere.php");
include("include/connect.php");
include("admintest/Modele/Modele.Personne.php");
?>

<?php
 $connection = Connect::getInstance();
	$req = "SELECT titre, texte, img, extension FROM contenus WHERE id=1";
	$res = $connection->query($req); 
	$table = $res->fetch_assoc();
	$img = $table["img"].'.'.$table["extension"];

	echo "<h1>".stripslashes($table["titre"])."</h1>";

	echo '<div class="section"><p style="text-align:justify" ><img src='.$img.' alt="action association" style="float: left; border: 0; margin-right:10px ; margin-bottom:10px" \>'.stripslashes($table["texte"]).'</p></div>';
	
        
        
        
        
//        $unePersonne = new Personne(null, null, null, null, null);
//        $unePersonne->chercher($connection, 8);
//        $unePersonne->setIdRole(5);
//        $unePersonne->modifier($connection);
        
//        $unePersonne->supprimer($connection);
        
//        $travaille = new Travaille();
//        $travaille->setIdPersonne(1);
//        $travaille->setIdProjet(2);
//        $travaille->setDateDebut(date("Y-m-d"));
//        $travaille->setDateFin(date("Y-m-d", mktime(0,0,0,9,12,2014)));
//        $travaille->ajouter($connection);
        //var_dump(date("Y-m-d"));
        //var_dump(date("Y-m-d", mktime(0,0,0,9,12,2014)));
?>

	<!--<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu odio eu velit tincidunt cursus quis sodales mauris. Vestibulum egestas ultrices auctor. Duis adipiscing <a href="index.html">click here &gt;&gt;</a></h4>-->
			 
            


<?php 

/* Traitement des requetes $_GET */
$controller = 'Presentation';
$action = 'index';
$id = '';
if(!empty($_GET['controller']))
	{
	$controller = $_GET['controller'];
	if(!empty($_GET['action']))
		{
		$action = $_GET['action'];
		if(!empty($_GET['id']))
			$id = $_GET['id'];
		}
	}
//On inclut le fichier s'il existe et s'il est spécifié
if(is_file('Controllers/'.$controller.'.Controller.php'))
	{
	include 'Controllers/'.$controller.'.Controller.php';
	$class = $controller."Controller";
	$objet = new $class($mysqli);
	$objet->$action($id);
	}
/* FIN*/



include("include/news.php");
include("include/footer.php");



?>