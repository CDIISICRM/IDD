<?php
//inclusion les models , utilisés par les actions de controlleur
// include(dirname(__FILE__).'/../Models/Partenaire.Model.php');
// include(dirname(__FILE__).'/../Models/Personne.Model.php');
// include(dirname(__FILE__).'/../Models/Projet.Model.php');
// include(dirname(__FILE__).'/../Models/Role.Model.php');

/*  controllers : Classe Abstraite */
abstract class Controller
	{
	/*Un tableau pour Récupère le données de contrôleur (provenant 
	éventuellement de models) pour usage futur(Dans les vues)*/
	protected $viewData = array();
	
	//Retourne la vue correspondante
	protected function View($action)
		{
		//Récupèrer le controlleur a partir de classe fille.
		$controller = str_replace('Controller', '', get_class($this));
		//La vue correspondant
		$view = $controller . '/' . $action.'.phtml';
		
		$inc = "dirname(__FILE__).'/../Views/'.$view";
		require_once(dirname(__FILE__).'/../Views/'.$view);
		}
	//Rederiction vers une action d'un contrôleur
	protected function RederictAction()
		{
		/*Récupération des paramétres : contrôleur(action index par défaut ou action d'un 
		contrôleur précis avec ou sans id identifiant d'un objet qui aurais subi l'action*/
		$arg_list = func_get_args();
		if(count($arg_list)== 1)
			$url = 'controller='.$arg_list[0];
		elseif(count($arg_list)== 2)
			$url = 'controller='.$arg_list[0].'&action='.$arg_list[1];
		else
			$url = 'controller='.$arg_list[0].'&action='.$arg_list[1].'
					&id='.$arg_list[2];
		echo '<script type="text/javascript">
				window.location = "?'.$url.'"</script>';
		}
	}
?>