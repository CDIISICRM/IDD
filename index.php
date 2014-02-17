<?php
require("./include/header_meta.php");
require("./include/menu.php");
include("./include/banniere.php");
include("./include/connect.php"); 
include("./modele/Role.php");
include("./modele/Personne.php");

?>

<?php

	//
        $con = new ConnectToDb();
        $mysqli = $con->getConnect();
        //$role = new Role("nouveauRole");
        //$role->ajouter($mysqli);
        
        //$role = new Role();
        //$role->chercher($mysqli, 3);
        //var_dump($role);
        
        //$role = new Role();
        //$lesRoles = $role->listerTout($mysqli);
        //var_dump($lesRoles);
        
        //$role = new Role();
        //$role->chercher($mysqli, 9);
        //$role->setNomRole("roleModifié");
        //$role->modifier($mysqli);
        
        //$role = new Role();
        //$role->chercher($mysqli, 9);
        //$role->supprimer($mysqli);
        
        $personne = new Personne("Pierrot", "Lalune", "Artiste", 8);
        $personne->ajouter($mysqli);

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


?>   


<?php 

/*$filesname= "numero.txt";

$id=fopen($filesname, "rw");
$lecture=fread($id,50);
fclose($id);
//echo($lecture);
$tab=explode("=",$lecture);
$num= $tab[1]+1;
$newchaine= $tab[0]."=".$num;
$id=fopen($filesname, "w");
if(flock($id,2)){
	fwrite($id,$newchaine);	*/



include("include/news.php");
include("include/footer.php");



?>