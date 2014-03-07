<?php
$accueilSelected = '';
$projetSelected = '';
$presseSelected = '';
$contactSelected = '';
$indexPage = false;		
if(strpos($_SERVER['REQUEST_URI'], 'ControlleurProjet') !== false)
	$projetSelected = ' class="selected"';
else if(strpos($_SERVER['REQUEST_URI'], 'Presse') !== false)
	$presseSelected = ' class="selected"';
else if(strpos($_SERVER['REQUEST_URI'], 'Contact') !== false)
	$contactSelected = ' class="selected"';
else
	{
	$indexPage = true;	
	$accueilSelected = ' class="selected"';
	}
?>
<body>
	<div id="page">
		<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="LOGO"></a>
			</div>
			<form action="rechercher.php" method="post" class="searchbar">
				<input type="text" value="Search" onFocus="this.select();" onMouseUp="return false;">
				<input type="submit" value="Go">
			</form>
			<ul id="navigation">
				<li<?php echo $accueilSelected; ?>>
					<a href="index.php">Accueil & Présentation</a>
				</li>
				<li<?php echo $projetSelected; ?>>
                    <a href="index.php?controller=ControlleurProjet&action=AfficherTousProjets&page=1&pagination=5">Réalisations</a>
				</li>
				<li<?php echo $presseSelected; ?>>
					<a href="index.php?controller=Presse&action=Presse_info">Presse</a>
				</li>
				<li<?php echo $contactSelected; ?>>
					<a href="index.php?controller=Contact&action=FormulaireContact">Contact</a>
				</li>
			</ul>
		</div>