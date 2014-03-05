<?php
// print('<pre>');
// print_r($_SERVER);
// print('</pre>');

$accueilSelected = '';
$projetSelected = '';
$presseSelected = '';
$contactSelected = '';
			
if($_SERVER['SCRIPT_NAME'] == '/detail_projet.php')
	{
	$projetSelected = ' class="selected"';
	}
else
	{
	switch($_SERVER['REQUEST_URI'])
		{
		case '/projets.php?page=1&pagination=5':
			$projetSelected = ' class="selected"';
			break;
		case '/index.php?controller=Presse&action=Presse_info':
			$presseSelected = ' class="selected"';
			break;
		case '/index.php?controller=Contact&action=FormulaireContact':
			$contactSelected = ' class="selected"';
			break;
		default:
			$accueilSelected = ' class="selected"';
		}
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
                    <a href="projets.php?page=1&pagination=5">Réalisations</a>
				</li>
				<li<?php echo $presseSelected; ?>>
					<a href="index.php?controller=Presse&action=Presse_info">Presse et partenaires</a>
				</li>
				<li<?php echo $contactSelected; ?>>
					<a href="index.php?controller=Contact&action=FormulaireContact">Contact</a>
				</li>
			</ul>
		</div>