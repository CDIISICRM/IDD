<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Modele.DAO.php';

class Travaille implements DAO{
    private $idPersonne;
    private $idProjet;
    private $dateDebut;
    private $dateFin;
    
    public function getIdPersonne() {
        return $this->idPersonne;
    }

    public function getIdProjet() {
        return $this->idProjet;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setIdPersonne($idPersonne) {
        $this->idPersonne = $idPersonne;
    }

    public function setIdProjet($idProjet) {
        $this->idProjet = $idProjet;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    
    
    
    
    
    
    
        function __construct() {
        
    }

    
    
    
    public function ajouter($mysqli) {
        $sql = "INSERT INTO travaille (idPersonne, idProjet, dateDeb, dateFin) VALUES(".$this->idPersonne.", ".$this->idProjet.", '".$this->dateDebut."', '".$this->dateFin."')";
        
        $mysqli->query($sql);
        
    }

    public function chercher($mysqli, $id) {
        
    }

    public static function listerTout($mysqli) {
        
    }

    public function modifier($mysqli) {
        
    }

    public function supprimer($mysqli) {
        
    }
    
    
    public static function chercherParPersonne($mysqli, $idPersonne){
        $lesTravaux = array();
        $sql = "SELECT * FROM travaille WHERE idPersonne=".$idPersonne;
        $res = $mysqli->query($sql);
        while ($row = $res->fetch_array()){
            $this->idPersonne = $row['idPersonne'];
            $this->idProjet = $row['idProjet'];
            $this->dateDebut = $row['dateDeb'];
            $this->dateFin = $row['dateFin'];
            
            $lesTravaux[] = $this;
        }
        return $lesTravaux;
    }

    
    public static function chercherParProjet($mysqli, $idProjet){
        $lesTravaux = array();
        $sql = "SELECT * FROM travaille WHERE idProjet=".$idProjet;
        $res = $mysqli->query($sql);
        while ($row = $res->fetch_array()){
            $this->idPersonne = $row['idPersonne'];
            $this->idProjet = $row['idProjet'];
            $this->dateDebut = $row['dateDeb'];
            $this->dateFin = $row['dateFin'];
            
            $lesTravaux[] = $this;
        }
        return $lesTravaux;
    }
}

