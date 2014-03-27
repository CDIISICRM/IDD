<?php


//bonjour

//include ('Modele.DAO.php');

class Role implements DAO{

    private $id;
    private $nomRole;
   
/*	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id=$value;
	}
		public function getNomRole(){
		return $this->nomRole;
	}
	public function setNomRole($value){
		$this->nomRole=$value;
	}
	*/
	
    public function __construct( $nomRole="", $id=null){
        $this->id = $id;
        $this->nomRole = $nomRole;
    }

	public function getId(){
		return $this->id;
	}
	
	public function getNomRole(){
		return $this->nomRole;	
	}
	
	
    public function setNomRole($nomRole) {
        $this->nomRole = $nomRole;
    }

        
    public function ajouter($mysqli) {
        $sql = "INSERT INTO roles (nomRole) VALUES('".$this->nomRole."')";
        $mysqli->query($sql);
        
    }

    public static function chercher($mysqli, $id) {
        $sql = "SELECT * FROM roles WHERE id = ".$id;
        $res = $mysqli->query($sql);
        $table = $res->fetch_row();
		$objRole = new role($table[1], $table[0]);
        return $objRole;
        
    }

    static public function listerTout($mysqli) {
        $lesRoles = array();
        $sql = "SELECT * FROM roles";
        $res = $mysqli->query($sql);
        
        while($row = $res->fetch_array()){
            $unRole = new Role();
            $unRole->id = $row['0'];
            $unRole->nomRole = $row['1'];
            $lesRoles[] = $unRole;
        }
        return $lesRoles;
    }

    public function modifier($mysqli) {
        $sql =  "UPDATE roles SET nomRole = '".$this->nomRole."' WHERE id = ".$this->id;
        $mysqli->query($sql);
        
    }

    public function supprimer($mysqli) {
        $sql = "DELETE FROM roles WHERE id = ".$this->id;
        $mysqli->query($sql);
    }

}
?>
