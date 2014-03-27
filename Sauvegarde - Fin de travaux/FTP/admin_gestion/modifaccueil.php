<?php
require_once('header.php');
require_once('../include/connect.php');
require('../include/class_upload.php');
$connection = Connect::getInstance();
?>
<script language="JavaScript">
var strTexte="!! FORMULAIRE INVALIDE !!\n\n";
function verif()
{
var strTexte="!! ERREUR DE SAISIE !!\n\n";
var good="1";
if (document.form1.titre.value=="" || document.form1.texte.value=="")
	{  
	strTexte+="Vous n'avez pas mentionné de titre!\n";
	strTexte+="ou vous n'avez pas mis de contenu ! \n";
	good="0";
	}
if (good=="0")
	{
	alert(strTexte);
	return false;
	}
else
	{
	return true;
	}
}
</script>

<?php
if(isset($_POST['valider'] ))
	{ 
	/***** TransfÃ¨re du fichier ****/
	$up = new upload('../media/', 'mon_fichier');
	$up->cl_taille_maxi = 64000000; // pour 49 Mo maximum
	$up->cl_extensions = array('.jpg', '.jpeg', '.png');

	if (!$up->uploadFichier('photo2'))
		{
		echo 'Erreur de transf&egrave;re<br/>';
		echo $up->affichageErreur();
		}
	else
		{
		echo"<center><strong>L'image à  bien été transféré.</strong></center>";
		}
		/***** Modification dans la base de donnÃ©e ****/
		$titre = addslashes($_POST['titre']);
		$texte = addslashes($_POST['texte']);
		$rq = "UPDATE contenus SET  titre='$titre', texte='$texte' WHERE id='1'"; 


		$connection->query($rq); 
		if(!$connection->errno && $erreur=="")
			{
			$titre = stripslashes($titre);
			$titre1 = stripslashes($_POST['titreancien']);
				
			echo"<center><strong>La page d'accueil a bien &eacute;t&eacute; modifi&eacute;e</strong></center>";
			echo '<meta http-equiv="refresh" content="2;URL=index.php">';
			}
		else 
			{
			echo 'ERREUR: '.$connection->errno.' Type: '.$connection->error.' SUR LA REQUETE: '.$rq;
			echo $erreur ;
			}
		
	}
else
	{
	$rq="SELECT titre, texte, img, extension FROM contenus WHERE id=1"; 
	$rquery= $connection->query($rq);  
	$conteneur= $rquery->fetch_assoc();
	$titre1=stripslashes($conteneur['titre']);
	$taccueil=stripslashes($conteneur['texte']);
	
	
	echo '
	<table align="center">
		<caption>Editer/Modifier la page d"accueil </caption>
		<form action="modifaccueil.php" method="post" name="form1" enctype="multipart/form-data" onsubmit=\"return verif()\" >
			<tr>
				<td align="right">
					<font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">TITRE</font> 
				</td>
				<td align="left">
					<input type="text" name="titre" value="'.$titre1.'" size="40" />
					<input type="hidden" name="titreancien" value="$titre1" />
				</td>
			</tr>
			<tr>
				<td align="right">
					<font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">TEXTE</font>
				</td>
				<td align="left">
					<textarea name="texte" cols="70" rows="30" >'; 
					  if($taccueil!="") {echo $taccueil;} 
					
					echo'</textarea>';
					
					?>
					
			<script type="text/javascript">
//<![CDATA[
	var editor = CKEDITOR.replace( 'texte',
	{
		toolbar :
		[
			//{ name: 'document',    items : [ 'Save','-','NewPage'] },
			{ name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
			{ name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
			 { name: 'colors',      items : [ 'TextColor','BGColor' ] }
		],
		uiColor : '#F1CA7F', // couleur de fond modifiable
	    height:"425", 
		autoGrow_minHeight : "425"
	});

//]]>
</script>
					<?php 
					echo'</td>
			</tr>
			<tr>
				<td><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Telecharger l\'image</font></td>
				<td>
					<input type="file" name="mon_fichier" value="" placeholder="Placer le fichier ici"/>
				</td>
			</tr>
			<tr>
				<td align="right" colspan="2">
					<input type="submit" name="valider" value="modifier" /> 
				</td>
			</tr>
		</form>  
	</table>';
	}
?>

<?php
include('footer.php');
?>