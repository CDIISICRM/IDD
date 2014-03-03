<?php
	/* Models : classe Projet */
	//Inclusion de Classe Mére
	require_once('Modele.DAO.php');
    require_once('Modele.Partenaire.php');
    require_once('Modele.Personne.php');
	
	class Projet implements DAO{
	//Les Attributs  : chaque attribut correspond a une colonne de la table produit.
	private $id;
	private $pNom;
	private $pObjectifs;
	private $pEtatActuel;
	private $pDateDeb;
	private $listPartenaire;
	private $listPersonne;
	private $photo_1;
	private $photo_2;
	private $tDateDebut;
    private $tDateFin;
        //Accesseurs et modificateurs des attributs privé (getters et setters)
		
	/*
		* @desc retourne id de l'objet courant
		* @return   id 
	*/
	
    public function __construct($nom, $objectifs, $etatActuel, $dateDeb, $photo_1, $photo_2, $idProjet =0)
       {
		if($idProjet == 0)
			{
			$this->id=$idProjet;
			$this->pNom=$nom;
			$this->pObjectifs=$objectifs;
			$this->pEtatActuel=$etatActuel;
			$this->pDateDeb=$dateDeb;
			//$this->listPartenaire;
			//$this->listPersonne;
			$this->photo_1=$photo_1;
			$this->photo_2=$photo_2;
			
			$listPartenaire= Partenaire::listerTout($GLOBALS['connection']);
			$listPersonne= Personne::listerTout($GLOBALS['connection']);
			}
		else
			{
			$this->chercher($GLOBALS['connection'], $idProjet);
			}
        }


       public function getId(){
		return $this->id;
	}
		
	/*
		* @desc   retourn pnom de l'objet courant
		* @return   le nom du projet 
	*/
	public function getPNom(){
		return $this->pNom;
	}
	/*
		* @desc change la valeur de l'attribut pNom aprés la validation
		* @param   str $value     valeur de l'attribut pNom
	*/
	public function setPNom($value){
		if(!empty($value))
			$this->pNom = $value;
		else{
			global $ErrorAttribut;
			$ErrorAttribut[] = "pNom";
		}
	}
		
	/*
		* @desc     retourne pObjectifs de l'objet courant
		* @return    pObjectifs 
	*/
	public function getPObjectifs(){
		return $this->pObjectifs;
	}
	/*
		* @desc   change la valeur de l'attribut pObjectifs aprés la validation
		* @param   	str $value valeur de l'attribut pObjectifs
	*/
	public function setPObjectifs($value){
		if(is_numeric($value)){
			$this->pObjectifs = $value;
                }else{
			global $ErrorAttribut;
			$ErrorAttribut[] = "pOjectifs";
		}
	}
        
        public function  getPhoto_1()
        {
            
        return $this->photo_1;
            
        }
        
         public function  getPhoto_2()
        {
            
            return $this->photo_2;
            
        }

        /*
		* @desc     retourne l'etat actuel  de l'objet courant
		* @return    pEtatActuel
	*/
	public function getEtatActuel(){
			return $this->pEtatActuel;
	}
	/*
		* @desc	 change la valeur de l'attribut de l'état actuel de l'objet aprés la validation
		* @param str $value     valeur de l'attribut pEtatActuel
	*/
	public function setEtatActuel($value){
            if (is_numeric($value)) {
            $this->pEtatActuel = $value;
        } else {
            global $ErrorAttribut;
            $ErrorAttribut[] = "pEtatActuel";
        }
    }
		
	/*
		* @desc     retourne la date  d'enregistrement de l'objet courant
		* @return    DateDeb 
	*/
	public function getDateDeb(){
			return $this->pDateDeb;
	}
        
        public function ListProjet($mysqli,$idPartenaire, $idProjet)
        {
            $rq="select * from partenaires inner join projets where partenaire.id= ".$idPartenaire."AND projets.id=".$idProjet;        
            $resultat =$mysqli->query($rq);
            $tab=$resultat->fetch_array();
            
            
           
            foreach($tab as $lig)
            {
                $tab[]=$lig;
                var_dump($tab);
                echo '<PRE>"'
                        .print_r($lig). 
                        '"</PRE>';                
            }
        }
                
           
    public function ajouter($mysqli) {
        $rqt = 'INSERT INTO projets (`nom`, `objectifs`, `etatActuel`, 
			`dateDeb`) VALUES ("'.$this->pNom.'", 
			'.$this->pObjectifs.', '.$this->pEtatActuel.', 
			'.$this->pDateDeb.')';
       $mysqli>query($rqt);
        
    }

    public function chercher($mysqli, $id) 
		{
        $rqt = "SELECT * FROM projets WHERE id = ".$id;
        $resultat = $mysqli->query($rqt);
        $data = $resultat->fetch_array();
		// var_dump($data);
        if(count($data)>0)
			{
            $this->id = $data['id'];
            $this->pNom = $data['nom'];
            $this->pObjectifs = $data['objectifs'];
            $this->pEtatActuel = $data['etatActuel'];
            $this->pDateDeb = $data['date_debut'];
            $this->photo_1=$data['photo_proj1'];
            $this->photo_2=$data['photo_proj2'];
            }
                 
		// A compléter
		// charger la liste des membres en relation avec le projet
		// changer la liste des partenaires en relation avec le projet
		}

    public static function listerTout($mysqli) {
        $lesProjets = array();
        $sql = "SELECT * FROM projets ";
        $res = $mysqli->query($sql);
        while($row = $res->fetch_array())
			{
            $unProjet = new Projet($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[0], $GLOBALS['connection']);
            $lesProjet[] = $unProjet;
			}
		return $lesProjet;
		}

    public function modifier($mysqli) {
          
    $rqt = '
	UPDATE Projets 
	SET 
		nom = "'.$this->pNom.'", 
        objectifs = '.$this->pObjectifs.', 
		etatActuel = '.$this->pEtatActuel.', 
		dateDeb = '.$this->pDateDeb.', 
		photo_proj1 = '.$this->photo_1.', 
		photo_proj2 = '.$this->photo_2.', 		
	WHERE 
		id = '.$this->id;
		
       // $mysqli->query($rqt);
        
    }

    public function supprimer($mysqli) {
        
        $rqt = 'DELETE FROM Projets WHERE id = '.$this->id;
		
       $mysqli->query($rqt);
    }

}
	
?>