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
				<li class="selected">
					<a href="index.php">Accueil & Présentation</a>
				</li>
				<li>
                    <a href="projet.php?page=1&pagination=5">Réalisations</a>
				</li>
				<li>
					<a href="index.php?controller=Presse&action=Presse_info">Presse et partenaires</a>
				</li>
				<li>
					<a href="index.php?controller=Contact&action=FormulaireContact">Contact</a>
				</li>
			</ul>
		</div>