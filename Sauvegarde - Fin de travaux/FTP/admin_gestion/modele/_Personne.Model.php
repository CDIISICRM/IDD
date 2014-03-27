<?php
	/* Models : classe Produit */
	//Inclusion de Classe Mére
	require_once('Model.Model.php');
	class PersonneModel extends Model{
	
	private $id;
	private $nom; 
	private $prenom;
	private $mail;
	private $Role;
	private $metier;
	
	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id=$value;
	}
	public function getNom(){
		return $this->nom;
	}

	public function setNom($value){
		if(!empty($value))
			$this->nom = $value;
		else{
			global $ErrorAttribut;
			$ErrorAttribut[] = "nom";
		}
	}
	public function getPrenom(){
		return $this->prenom;
	}
	public function setPrenom($value){
		$this->prenom = $value;
	}
	public function getMail(){
		return $this->mail;
	}
	public function setMail($value){
                $this->mail = $value;
	}
	public function getMetier(){
			return $this->metier;
	}
	public function setMetier($value){
                        $this->metier = $value;
	}
	public function getRole(){
		return $this->Role;
	}
	public function setRole($value){
		$this->Role = $value;
	}
		
	//CRUD : Create   Red    Update  Delete		
	public function addPersonne(){
		$rqt = 'INSERT INTO Personnes (nom, prenom, mail, idRole, metier) VALUES ("'.$this->nom.'", 
			'.$this->prenom.', '.$this->mail.', '.$this->metier.', '.$this->Role->id.')';
                $base = Connect::getInstance();
                $base->query($rqt);
                $base->close();
	}

	public function updatePersonne($idPersonne){
		$rqt = 'UPDATE Personnes SET nom = "'.$this->nom.'", prenom = '.$this->prenom.', mail = '.$this->mail.', 
			idRole = '.$this->Role->id.', metier = '.$this->metier. ' WHERE id = '.$id;
                $base = Connect::getInstance();
                $base->query($rqt);
                $base->close();
	}

	public function deletePersonne($id){
		$rqt = 'DELETE FROM Personnes WHERE id = '.$id;
                $base = Connect::getInstance();
                $base->query($rqt);
                $base->close();
	}

	public function listPersonnes(){
                $tab = array();
		$rqt = "SELECT * FROM Personnes";
                $base = Connect::getInstance();
                $result = $base->query($rqt);
		while($data = $result->fetch_assoc())
			$tab[] = $data; 
                $base=null;
		return $tab;// $base->close();
                 
	}
	//Recherche
	public function findPersonne($id){
		$rqt = mysql_query("SELECT * FROM Personnes WHERE id = ".$id);
                $base = Connect::getInstance();
                $result = $base->query($rqt); //		$rqt = mysql_query("SELECT * FROM Roles WHERE id = ".$id);	
                $data = $result->fetch_assoc();
		if(count($data)>0){
			$this->id = $data['id'];
			$this->nom = $data['nom'];
			$this->prenom = $data['prenom'];
			$this->mail = $data['mail'];
			$this->metier = $data['metier'];
                        $this->Role = $data['Role'];
		
                        return $this;
                }
		$base->close();
	}
}
	
?>