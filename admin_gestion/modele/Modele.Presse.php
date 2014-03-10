<?php

include_once('Modele.DAO.php');

class Presse implements DAO{
    public $id;
    public $titre;
    public $source;
    public $auteur;
	public $lien;
    public $dateParution;
    
    function __construct($titre, $source, $auteur, $lien,$pdf, $dateParution, $id=0) {
        $this->id = $id;
        $this->titre = $titre;
        $this->source = $source;
        $this->auteur = $auteur;
		$this->lien = $lien;
		$this->pdf=$pdf;
		$this->dateParution = $dateParution;
    }

        public function ajouter($mysqli) {
        $sql = "
		INSERT INTO 
			presses 
		VALUES
			(
			'', 
			'".addslashes($this->titre)."', 
			'".addslashes($this->source)."', 
			'".addslashes($this->auteur)."', 
			'".$this->lien."', 
			'".addslashes($this->pdf)."',
			'".$this->dateParution."'
			)";
			
			//echo $sql.'<br/>';
		$mysqli->query($sql);
        $this->id = $mysqli->insert_id;
        
    }

    public static function chercher($mysqli, $id) {
        $sql = "SELECT * FROM presses WHERE id = ".$id;
        $res = $mysqli->query($sql);
        $row = $res->fetch_row();
        
		$presse = new Presse($row[1], $row[2], $row[3], $row[4], $row[5],$row[6], $row[0]);
		
		return $presse;
    }

    static public function listerTout($mysqli) {
        $lesArticles = array();
        $sql = "SELECT * FROM presses ";
        $res = $mysqli->query($sql);
        while($row = $res->fetch_array()){
            
            $unArticle = new Presse($row[1], $row[2], $row[3], $row[4], $row[5],$row[6], $row[0]);
            $lesArticles[] = $unArticle;
            
        }
        return $lesArticles;
    }

    public function modifier($mysqli) {
		  $sql = 'UPDATE presses SET 
		  titre = "'.addslashes($this->titre).'", 
		  source = "'.addslashes($this->source).'", 
		  auteur = "'.addslashes($this->auteur).'", 
		  lien = "'.addslashes($this->lien).'",
		  pdf="'.addslashes($this->pdf).'", 
		  dateParution = "'.addslashes($this->dateParution).'" 
		  WHERE id='.$this->id;
		  
		$mysqli->query($sql);
        
        
    }

    public function supprimer($mysqli) {
        $sql = "DELETE FROM presses WHERE id = ".$this->id;
        $mysqli->query($sql);
        
    }
    
}

?>