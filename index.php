<?php
require("include/header_meta.php");
require("include/menu.php");
include("include/banniere.php");
include("include/connect.php"); 
include('modele/Role.php');
?>

<?php
	//
        
        $role = new Role("nouveauRole");
        $role->ajouter();
?>

	<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu odio eu velit tincidunt cursus quis sodales mauris. Vestibulum egestas ultrices auctor. Duis adipiscing <a href="index.html">click here &gt;&gt;</a></h4>
			
            


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