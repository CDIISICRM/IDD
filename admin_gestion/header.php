<?php 
session_start();

/*
include_once(dirname(__FILE__).'/modele/LoginModel.php');
include_once(dirname(__FILE__).'/Controllers/LoginController.php'); 
	
if(!LoginModel::EstConnecte() && isset($_POST))
	LoginController::SessionStart($_POST);

if((isset($_GET['action']) && $_GET['action'] = 'FinSession') || !LoginModel::EstConnecte())
	{
	session_unset();
	echo '<meta http-equiv="refresh" content="0; url=login.html">';
 * '<script type="text/javascript">window.location = "?'.$ech.'"</script>';
	exit();
	}*/
?>
<html>
	<head>
		<title>Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="../jquery/jquery-ui-1.9.2/themes/base/jquery-ui.css" type="text/css">
		<link rel="stylesheet" href="../jquery/jquery-ui-1.9.2/themes/base/jquery.ui.datepicker.css" type="text/css">
		
		<script language="javaScript" src="jQuery/jQuery.js"></script>
		<script language="javaScript" src="jQuery/jquery-ui-1.10.4.custom.min.js"></script>
		<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.min.css" type="text/css">
		<script language="JavaScript" src="../fonctions.js"></script>
	</head>
        <body background="im/fond.gif"><center><h1>M C D A</h1></center>
            <?php require_once("Login.php"); 
            if (!LoginModel::EstConnecte()) {    LoginVue::Login(); exit();  }
            ?>
		<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" bgcolor="#FFFFFF">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="15">
						<tr>
							<td width="25%" valign="top">
								<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#000000">
									<tr>
										<td background="im/fond.gif">
											<center>
												<font color="#FFFFFF">
													<strong>Gestion du portfolio</strong>
												</font>
											</center>
										</td>
									</tr>
									<tr>
										<td>
											<ul>
												<li>
													<a href="add_portfolio.php">Ajouter au portfolio</a>
												</li>
												<li>
													<a href="portfolio.php">Modifier le portfolio</a>
												</li>
											</ul>
										</td>
									</tr>
								</table>
								<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#000000">
									<tr>
										<td background="im/fond.gif">
											<center>
												<font color="#FFFFFF">
													<strong>Gestion du contenu des pages </strong>
												</font> 
											</center>
										</td>
									</tr>
									<tr>
										<td>
											<ul>
												<li>
													<a href="modifaccueil.php">Editer/Modifier rubrique accueil</a>
												</li>
												<li>
													<a href=" listemembre.php ">Gerer les membres de l'association</a>
												</li>
												<li>
													<a href=" listerole.php ">Gerer les rôles dans l'association</a>
												</li>
												<li>
													<a href=" listepartenaire.php ">Gerer les partenaires</a>
												</li>
												<li>
													<a href="listprojet.php">Gerer les projets</a>
												</li>
                                                                                                <?php echo AdminSiteVue::Menu(AdminSiteModel::$id); ?>
											</ul>
										</td>
									</tr>
								</table>
							</td> 
							<td valign="top">
								<center>
									<font size="1">
										<strong>
											<a href="http://www.mcda-asso.com" alt="http://www.mcda-asso.com" target="_blank">Voir le site</a>
											<span>&nbsp;|&nbsp;</span>
											<a href="index.php">Accueil administration</a>
											<span>&nbsp;|&nbsp;</span>
											<a href="index.php?TypeDeClasse=controller&NomDeClasse=Login&Methode=FinSession">Déconnexion</a>
										</strong>
									</font>
								</center>
								<hr color="black">
								<br><br>
								<div id="mainContent">


