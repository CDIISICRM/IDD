<?php


include '/include/connect.php';

include 'DAO.php';

class Role implements DAO{

    private $id;
    private $nomRole;
   

    public function __construct( $nomRole="", $id=null){
        $this->id = $id;
        $this->nomRole = $nomRole;
    }

    public function ajouter() {
        $sql = "INSERT INTO roles.nomRole VALUES(".$this->nomRole.")";
        $connect = new ConnectToDb();
        $mysqli = $connect->getConnect();
        $mysqli->query($sql);
        
        
    }

    public function chercher(int $id) {
        
    }

    public function listerTout() {
        
    }

    public function modifier() {
        
    }

    public function supprimer() {
        
    }

}
?>
