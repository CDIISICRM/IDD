<?php
include("DAO.php");
class Personne implements DAO{
    private $id;
    private $nom;
    private $prenom;
    private $metier;
    private $idRole;
    
    function __construct($nom, $prenom, $metier, $idRole, $id=0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->metier = $metier;
        $this->idRole = $idRole;
    }

    public function ajouter($mysqli) {
        $sql = "INSERT INTO personnes (nom, prenom, metier, idRole) VALUES('".$nom."', '".$prenom."', '".$metier."', ".$idRole.")";
        $mysqli::query($sql);
        var_dump($mysqli::insert_id);
        
    }

    public function chercher($mysqli, $id) {
        
    }

    public function listerTout($mysqli) {
        
    }

    public function modifier($mysqli) {
        
    }

    public function supprimer($mysqli) {
        
    }

}