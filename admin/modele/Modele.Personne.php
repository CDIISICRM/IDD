<?php

require_once('Modele.DAO.php');

class Personne implements DAO{
    public $id;
    public $nom;
    public $prenom;
    public $metier;
    public $email;
    public $idRole;
    
    function __construct($nom, $prenom, $metier,$email, $idRole, $id=0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->metier = $metier;
        $this->email = $email;
        $this->idRole = $idRole;
    }

    
    public function setIdRole($idRole) {
        $this->idRole = $idRole;
    }

        public function ajouter($mysqli) {
        $sql = "INSERT INTO personnes (nom, prenom, mail, metier, idRole) VALUES('".$this->nom."', '".$this->prenom."', '".$this->email."','".$this->metier."', ".$this->idRole.")";
        $mysqli->query($sql);
        $this->id = $mysqli->insert_id;
        
    }

    public static function chercher($mysqli, $id) {
        $sql = "SELECT * FROM personnes WHERE id = ".$id;
        $res = $mysqli->query($sql);
        $row = $res->fetch_row();
        $unePersonne = new Personne(
        $row[1],
        $row[2],
        $row[5],
        $row[3],
        $row[4],
        $row[0]);
        
        return $unePersonne;
    }


    public static function listerTout($mysqli) {

        $lesPersonnes = array();
        $sql = "SELECT * FROM personnes ";
        $res = $mysqli->query($sql);
        while($row = $res->fetch_array()){
            
            $unePersonne = new Personne($row[1], $row[2], $row[5], $row[3], $row[4], $row[0]);
            $lesPersonnes[] = $unePersonne;
            
        }
        return $lesPersonnes;
    }
	
	
	

    public function modifier($mysqli) {
        $sql = "UPDATE personnes SET nom = '".$this->nom."', prenom = '".$this->prenom."', mail = '".$this->email."', idRole = ".$this->idRole.", metier = '".$this->metier."' WHERE id= ".$this->id;
        $mysqli->query($sql);
        
        
    }

    public function supprimer($mysqli) {
        $sql = "DELETE FROM personnes WHERE id = ".$this->id;
        $mysqli->query($sql);
        
    }
    
    public static function listerParIdProjet($mysqli, $idProjet){
        $lesPersonnes = array();
        $sql = 'SELECT p.nom, p.prenom, p.metier, p.mail, p.idRole FROM personnes AS p, travaille, projets '
                . 'WHERE p.id = travaille.idPersonne '
                . 'AND travaille.idProjet = projets.id '
                . 'AND travaille.idProjet = '.$idProjet;
        $res = $mysqli->query($sql);
        
        while($row = $res->fetch_array()){
            $unePersonne = new Personne($row['nom'],
                    $row['prenom'],
                    $row['metier'],
                    $row['mail'],
                    $row['idRole']);
            $lesPersonnes[] = $unePersonne;
        }
        return $lesPersonnes;
    }

}

?>