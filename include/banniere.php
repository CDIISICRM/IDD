<div id="contents">
	<div id="intro">
		<img src="media/photo.jpg" alt="Img" height="444" width="630">
		<div class="info">
			<h1>MCDA Qui sommes nous?</h1>
			<p align="justify">
				MCDA, association franco-marocaine, est créée en 1995 par des immigrés de la région Sud Alsace et des français d'origine, tous soucieux d'un meilleur développement des pays du Sud.
La démarche globale de MCDA est fondée sur la mobilisation et l'organisation des immigrés autour de projets concrets de développement local, soit collectifs tels que l'électrification, la recherche de l'eau, l'aménagement d'écoles ou de dispensaires, soit individuels tels que la création d'entreprise (artisanat, services, élevage...). 
			</p>
		</div>
	</div>
            
<?php
	$controller='index';
	$action='afficher_index';
	$id='';
	if (!empty($_GET['controller']))
	{
		$controller=$_GET['controller'];
		if (!empty($_GET['action']))
		{
			$action=$_GET['action'];
			if (!empty($_GET['id']))
			{
				$id=$_GET['id'];
			}
		}
	}
	if (is_file('admin/Controllers/Controller.'.$controller.'.php'))
	{
		include 'admin/Controllers/Controller.'.$controller.'.php';
		$class=$controller;
		$objet=new $class();
		$objet->$action($id);
	}
		
?>
	