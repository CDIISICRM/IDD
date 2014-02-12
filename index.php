<?php
require("include/header_meta.php");
require("include/menu.php");
include("include/banniere.php");
include("include/connect.php"); 
?>

<?php
	$req = "SELECT titre, texte, img, extension FROM contenus WHERE id=1";
	$res = $mysqli->query($req);
	$table = $res->fetch_assoc();
	$img = $table["img"].'.'.$table["extension"];

	echo "<h1>".utf8_encode($table["titre"])."</h1>";
	echo '<div class="section"><p>'.utf8_encode($table["texte"]).'</p></div>';
	echo '<img src='.$img.' alt="action association" style="float: left; border: 0;" \>';
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