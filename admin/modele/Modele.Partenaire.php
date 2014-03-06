<?php

include_once('Modele.DAO.php');

class Partenaire implements DAO{
    public $id;
    public $nom;
    public $siteInternet;
    public $logo;
    public $sygle;
    
    function __construct($nom, $siteInternet, $logo,$sygle, $id=0) {
        $this->id = $id;
        $this->nom = $nom;
        $this->siteInternet = $siteInternet;
        $this->logo = $logo;
        $this->sygle = $sygle;
    }

        public function ajouter($mysqli) {
        $sql = "INSERT INTO partenaires (nom, siteInternet, logo, sygle) VALUES('".$this->nom."', '".$this->siteInternet."', '".$this->logo."', '".$this->sygle."')";
		$mysqli->query($sql);
        $this->id = $mysqli->insert_id;
        
    }

    public static function chercher($mysqli, $id) {
        $sql = "SELECT * FROM partenaires WHERE id = ".$id;
        $res = $mysqli->query($sql);
        $row = $res->fetch_row();
        
		$partenaire = new Partenaire($row[1], $row[2], $row[4], $row[3], $row[0]);
		
		return $partenaire;
    }

    static public function listerTout($mysqli) {
        $lesPartenaires = array();
        $sql = "SELECT * FROM partenaires ";
        $res = $mysqli->query($sql);
        while($row = $res->fetch_array()){
            
            $unPartenaire = new Partenaire($row[1], $row[2], $row[4], $row[3], $row[0]);
            $lesPartenaires[] = $unPartenaire;
            
        }
        return $lesPartenaires;
    }

    public function modifier($mysqli) {
        $sql = "UPDATE partenaires SET nom = '".$this->nom."', siteInternet = '".$this->siteInternet."', logo = '".$this->logo."', sygle = '".$this->sygle."' WHERE id=".$this->id;
		$mysqli->query($sql);
        
        
    }

    public function supprimer($mysqli) {
        $sql = "DELETE FROM partenaires WHERE id = ".$this->id;
        $mysqli->query($sql);
        
    }
    
    public static function listerParIdProjet($mysqli, $idProjet){
        $lesPartenaires = array();
        $sql = 'SELECT p.nom, p.siteInternet, p.logo, p.sygle, p.id FROM partenaires AS p, agit, projets  WHERE p.id = agit.idPartenaire '
                . 'AND projets.id = agit.idProjet '
                . 'AND agit.idProjet = '.$idProjet;
        $res = $mysqli->query($sql);
       
        while ($row = $res->fetch_array()){
            $unPartenaire = new Partenaire(
                    $row['nom'],
                    $row['siteInternet'],
                    $row['logo'],
                    $row['sygle'],
                    $row['id']);
            $lesPartenaires[] = $unPartenaire;
        }
        return $lesPartenaires;
    }

}

?>