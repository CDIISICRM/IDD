<?php
	/* Models : classe Produit */
	//Inclusion de Classe Mére
	require_once('Model.Model.php');
	class RoleModel extends Model{
	private $id;
	private $nomRole; 
	public function getId(){
            return $this->id;
	}	
	public function getNomRole(){
		return $this->nomRole;
	}
	public function setNomRole($value){
		if(!empty($value))
			$this->nomRole = $value;
		else{
			global $ErrorAttribut;
			$ErrorAttribut[] = "nomRole";
		}
	}	
	public function addRole(){
		$rqt = 'INSERT INTO Roles (nomRole) VALUES ("'.$this->nomRole.'")';
                $base = Connect::getInstance();
		$base->query($rqt);
                $base->close();
	}
	public function updateRole($id){
		$rqt = 'UPDATE Roles SET nomRole = "'.$this->nomRole.'" WHERE id = '.$id;
                $base = Connect::getInstance();
		$base->query($rqt);
                $base->close();
	} 
	public function deleteRole($id){
		$rqt = 'DELETE FROM ROLES WHERE id = '.$id;
                $base = Connect::getInstance();
		$base->query($rqt);
                $base->close();
	}
	public function listRoles(){ 
                $tab = array(); 
		$rqt = "SELECT * FROM Roles";
                $base = Connect::getInstance();
                $result = $base->query($rqt); //or die ("Error" . " File: " . __FILE__ . " on line: " . __LINE__);    
		while($data = $result->fetch_assoc())
			$tab[] = $data; 
                $base=null;
		return $tab;   
        }
	public function findRole($id){
                $rqt = "SELECT * FROM Roles WHERE id = ".$id;
                $base = Connect::getInstance();
                $result = $base->query($rqt); //		$rqt = mysql_query("SELECT * FROM Roles WHERE id = ".$id);	
                $data = $result->fetch_assoc();
	/*	if(count($data)>0){
			$this->id = $data['id'];
			$this->nomRole = $data['nomRole'];
            */    $base=null;
                return $data;
           //     }
	
	}
          
}
	
?>