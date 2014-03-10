<?php
require_once('header.php');
require_once('modele/Modele.Presse.php');

$mysqli = Connect::getInstance();

$getid=$_GET['id'];
$Presse=Presse::chercher($mysqli, $_GET['id']);

if(isset($_POST['valider'] ))
	{ 
	$presse1=new Presse($_POST['titre'],$_POST['source'],$_POST['auteur'],$_POST['lien'],$Presse->pdf, $_POST['dateParution'], $getid);
	$presse1->supprimer($mysqli);
	if (is_file('../media/'.$Presse->pdf)) unlink('../media/'.$Presse->pdf);
	echo "<center><strong>La suppression a été enregistrée.</strong></center>";
	echo '<meta http-equiv="refresh" content="2;URL=listearticles.php">';
	}
else
	{
	echo '
	<form action="supprimer_article.php?id='.$getid.'" method="post" name="form1" enctype="multipart/form-data">
		<table align="center" id="formarticle">
			<caption>Supprimer un article de Presse </caption>
			<tr>
				<td class="label">
					<span>Titre</span>
				</td>
				<td>
					<input type="text" readonly name="titre" value="'.$Presse->titre.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Source</span>
				</td>
				<td>
					<input type="text" readonly name="source" value="'.$Presse->source.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Auteur</span>
				</td>
				<td>
					<input type="text" readonly name="auteur" value="'.$Presse->auteur.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Lien</span>
				</td>
				<td>
					<input type="text" readonly name="lien" value="'.$Presse->lien.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>pdf</span>
				</td>
				<td>
					<input type="text" readonly name="pdf" value="'.$Presse->pdf.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<span>Date Parution</span>
				</td>
				<td>
					<input type="text" readonly name="dateParution" value="'.$Presse->dateParution.'" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label" colspan="2">
					<input type="button" value="Retour" onClick="Javascript: window.history.back();"/>
					&nbsp;&nbsp;
					<input type="submit" name="valider" value="Supprimer ?" /> 
				</td>
			</tr>
		</table>
	</form>';
	}

include('footer.php');
?>