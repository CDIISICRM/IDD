<?php

include_once 'DAO.php';

class Personne implements DAO{
    private $id;
    private $nom;
    private $prenom;
    private $metier;
    private $email;
    private $idRole;
    
    function __construct($nom, $prenom, $metier,$email, $idRole, $id=0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->metier = $metier;
        $this->email = $email;
        $this->idRole = $idRole;
    }

    public function ajouter($mysqli) {
        $sql = "INSERT INTO personnes (nom, prenom, mail, metier, idRole) VALUES('".$this->nom."', '".$this->prenom."', '".$this->email."','".$this->metier."', ".$this->idRole.")";
        $mysqli->query($sql);
        $this->id = $mysqli->insert_id;
        
    }

    public function chercher($mysqli, $id) {
        $sql = "SELECT * FROM personnes WHERE id = ".$id;
        $res = $mysqli->query($sql);
        $row = $res->fetch_row();
        
        $this->id = $row[0];
        $this->nom = $row[1];
        $this->prenom = $row[2];
        $this->email = $row[3];
        $this->idRole = $row[4];
        $this->metier = $row[5];
    }

    public function listerTout($mysqli) {
        
    }

    public function modifier($mysqli) {
        
    }

    public function supprimer($mysqli) {
        
    }

}

?>