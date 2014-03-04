<?php
class Contact
{
	public function FormulaireContact($val = false, $error = '')
	{
		$nom="";
		$prenom="";
		$mail="";
		$message="";
		
		if($val)
			{
			$nom = $val['nom'];
			$prenom = $val['prenom'];
			$mail = $val['mail'];
			$message = $val['message'];
			}
		
		$msgError = '';
		if($error != '')
			$msgError = '<ul>'.$error.'</ul>';
			
			
		echo $msgError.'	<form action="index.php?controller=Contact&action=EnvoyerFormulaire" method="POST">
				<label for="nom">Nom : </label><input type="text" name="nom" id="nom" value="'.$nom.'" />
				<label for="prenom">Prénom : </label><input type="text" name="prenom" id="prenom" value="'.$prenom.'" />
				<label for="mail">Courriel : </label><input type="text" name="mail" id="mail" value="'.$mail.'" />
				<label for="message">Message : </label><textarea name="message" id="message" cols="20" rows="10" >'.$mail.'</textarea>
				<input type="submit" name="Valider" value="Envoyer le message" />
				</form>';
				
	}
	
	public function EnvoyerFormulaire()
	{
	
		$error = false;
		
		
		if(empty($_POST['nom']) || $_POST['nom'] == '' )
		{
			$error .='<li class="error">Veuillez Saisir votre nom.</li> ';
		
		}
		
		if(empty($_POST['mail']) ||  $_POST['mail'] == '')
		{
			$error.='<li class="error">Veuillez saisir votre Courriel.</li>';
		}
		else if($this->VerifierAdresseMail($_POST['mail']))
		{
			$error.='<li class="error">Veuillez saisir une adresse mail valide.</li>';
		}
		
		if(empty($_POST['message']) ||  $_POST['message'] == '')
		{
			$error.='<li class="error">Veuillez saisir un message.</li>';
		}
		
		
		//verifier si il il a des error de saisie dans les champs obligatoires.
		if($error)
		{
			$this->FormulaireContact($_POST, $error);
		
		
		}else{
		
				$to      = $_POST['mail'];
				$subject = 'Message du site : '.$_POST['nom'].' '.$_POST['prenom'] ;
				$message = $_POST['message'];
				$headers = 'From: baptiste.derouin@free.fr' . "\r\n" .
					'Reply-To: baptiste.derouin@free.fr' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				// @ ne vas pas afficher le message d'error en local
				@mail($to, $subject, $message, $headers);
				
				echo'<p>Nous avons pris en considération votre message.</p>';
		}
	}
	
	public function VerifierAdresseMail($adresse)
		{
		//Adresse mail trop longue (254 octets max)
		if(strlen($adresse)>254)
			return '<p>Votre adresse est trop longue.</p>';

		//Caractères non-ASCII autorisés dans un nom de domaine .eu :
		$nonASCII='ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
		$nonASCII.='ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
		$nonASCII.='ũūŭůűųŵŷźżztșțΐάέήίΰαβγδεζηθικλμνξοπρςστυφ';
		$nonASCII.='χψωϊϋόύώабвгдежзийклмнопрстуфхцчшщъыьэюяt';
		$nonASCII.='ἀἁἂἃἄἅἆἇἐἑἒἓἔἕἠἡἢἣἤἥἦἧἰἱἲἳἴἵἶἷὀὁὂὃὄὅὐὑὒὓὔ';
		$nonASCII.='ὕὖὗὠὡὢὣὤὥὦὧὰάὲέὴήὶίὸόὺύὼώᾀᾁᾂᾃᾄᾅᾆᾇᾐᾑᾒᾓᾔᾕᾖᾗ';
		$nonASCII.='ᾠᾡᾢᾣᾤᾥᾦᾧᾰᾱᾲᾳᾴᾶᾷῂῃῄῆῇῐῑῒΐῖῗῠῡῢΰῤῥῦῧῲῳῴῶῷ';
		
		// note : 1 caractète non-ASCII vos 2 octets en UTF-8
		$syntaxe="#^[[:alnum:][:punct:]]{1,64}@[[:alnum:]-.$nonASCII]{2,253}\.[[:alpha:].]{2,6}$#";

		if(preg_match($syntaxe,$adresse))
			{
			return true;
			}
		else
			{
			return false;
			}
		}
	

}
?>