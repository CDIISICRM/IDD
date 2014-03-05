<?php
require_once("include/header_meta.php");
require_once("include/menu.php");
require_once("include/connect.php");
require_once("include/banniere.php");
require("admintest/modele/Modele.Projet.php");

$connection = Connect::getInstance();

$tableau = Projet::listerAlea($connection);

print('<h1>Tous les projets</h1>');

?>
	  <script type="text/javascript">
		  
  
	  $(function() {
		  $( "#accordion" ).accordion();
	  });
	  </script>
<?php

$comboChoixPagination = '
	<select id="cbPagination" onChange="Javascript: window.location.href=\'projets.php? page=1&pagination=\'+this.options[this.selectedIndex].value;">
		<option value="5">5 projets / page</option>
		<option value="6">6 projets / page</option>
		<option value="7">7 projets / page</option>
		<option value="8">8 projets / page</option>
		<option value="9">9 projets / page</option>
		<option value="10">10 projets / page</option>
	</select>
';
$nompreItems = $_GET['pagination'];


if(count($tableau) % $nompreItems != 0){
	
$nombreDePages = floor(count($tableau) / $nompreItems) +1;
}
else{
	$nombreDePages = floor(count($tableau) / $nompreItems);
}

echo '<div id="pagination">'.$comboChoixPagination.' : ';
for($j=1 ; $j<=$nombreDePages; $j++){
	echo'<a href="projets.php?page='.$j.'&pagination='.$nompreItems.'" target="_blank">| Page '.$j.' |</a>';	
}
echo '</div>';
$pageCourante = $_GET['page'];
echo'
<div id="accordion" >';

for($i=($pageCourante -1)*$nompreItems; $i<=($pageCourante * $nompreItems -1);$i++)
{
	if($tableau[$i][0] != "" || $tableau[$i][0] != NULL){
	echo'<h3 style="padding-left:30px">'.$tableau[$i][1].'</h3><div>';
 echo ("<p class='demoHeaders'>".$tableau[$i][2].'</p><br />
</div>');
	}
}
echo'</div><br/><br/>';
/*$connection = Connect::getInstance();

print('<h1>Tous les projets</h1>');

require_once("include/news.php");
require_once("include/footer.php");
?>*/
require_once("include/footer.php");
?>
