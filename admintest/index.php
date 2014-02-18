<?php

require_once('header.php');
/*$civilite=$_COOKIE['civil'];
$nom=$_COOKIE['nom']*/

echo"Bienvenue  " .$civilite."  ".$nom."  sur l'interface d'administration du site MCDA  <br/>";
/*$chaine=$_COOKIE['tableau_user'];
echo($chaine);
$tab_res=array();
echo ("Les autres utilisateurs que vous gérez sont :<br/>");
$tab_res=unserialize($_COOKIE['tableau_user']);
echo("<ul>");

  echo (count( $tab_res));
   
   
echo("tab :".$tab_res[1]);


echo("</ul>");*/

/*$filename="../includes/compteur.txt";
$id=fopen($filename,"r");
$read=fread($id,50);
fclose($id);
$table=explode("=",$read,10);
$affiche=$table[1];*/

echo"<br />
<br />
<br />
<p>Nombre de visiteurs : ".$affiche."</p>";
include('footer.php');

?>