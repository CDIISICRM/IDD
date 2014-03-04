<?php 
session_start();

include_once(dirname(__FILE__).'/modele/LoginModel.php');
include_once(dirname(__FILE__).'/Controllers/LoginController.php'); 
	
if(!LoginModel::EstConnecte() && isset($_POST))
	LoginController::SessionStart($_POST);
	
if((isset($_GET['action']) && $_GET['action'] = 'FinSession'))
	{
	unset($_SESSION);
	echo '<meta http-equiv="refresh" content="0; url=login.phtml">';
	exit();
	}
// $connecte = ? true :  

// if (!$connecte)
	// $logincontroller->viewcontroller->Vue("login.phtml","modeheader");    
?>
<html>
<head>
<title>Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
A:link {color: black;text-decoration:none;} A:visited {color: black;text-decoration:none;} A:hover {color: red;text-decoration:underline;} 
td{color:black;font-size:11px;font-family: Verdana, Arial, Helvetica}
</style>
<script language="javaScript" src="jQuery/jQuery.js"></script>
<script language="javaScript" src="jQuery/jquery-ui-1.10.4.custom.min.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.min.css" type="text/css">
<script language="JavaScript" src="../fonctions.js"></script>
</head>
<body background="im/fond.gif">
<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="25%" valign="top">

<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#000000">
  <tr>
    <td background="im/fond.gif"><center><font color="#FFFFFF"><strong>Gestion du portfolio</strong></font></center></td>
  </tr>
  <tr>
    <td>
	<a href="add_portfolio.php"><li>Ajouter au portfolio</li></a>
	<a href="portfolio.php"><li>Modifier le portfolio</li></a>
	</td>
  </tr>
</table><br>
<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#000000">
  <tr>
    <td background="im/fond.gif"><center>
                <font color="#FFFFFF"><strong>Gestion du contenu des pages </strong></font> 
              </center></td>
  </tr>
  <tr>
    <td>
	
			  <a href="modifaccueil.php">
              <li>Editer/Modifier rubrique accueil</li>
              </a>
			  
              <li>
              <a href=" listemembre.php ">Gerer les membres de l'association</a>
              </li>
               <li>
              <a href=" listerole.php ">Gerer les rôles dans l'association</a>
              </li>

	      <li>
              <a href=" listepartenaire.php ">Gerer les partenaires</a>
              </li>

              
			  
              <li><a href="listprojet.php">Gerer les projets</li>
			  
              </a>
			  <a href="formation.php">
			  <li>Editer/Modifier la rubrique formations</li>
			  </a>
	
			
	
	</td>
  </tr>
</table>

</td>
    <td valign="top"><center><font size="1"><strong><a href="index.php">Accueil administration</a>&nbsp;|&nbsp;<a href="index.php?controller=Login&action=FinSession">Déconnexion</a><br> <hr color="black"></strong></font></center><br><br>

