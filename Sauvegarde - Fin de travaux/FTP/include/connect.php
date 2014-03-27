<?php


    class Connect{
    
    private static $mysqli = null;
    private  $host='localhost';
    private  $user='root';
    private  $pass='';
    private  $base='mcdaassomag';
    
    private function __construct() {}

        static public final function getInstance() {
        if (is_null(self::$mysqli)){
              self::$mysqli=new mysqli("mysql51-113.perso", "mcdaassomag", "B82mhsp7", "mcdaassomag");
              if(self::$mysqli->connect_errno) 
              {    
                  echo "Echec de la connection".self::$mysqli->connect_errno."  ".self::$mysqli->connect_error;
              }
        }   
        if (mysqli_connect_errno()) {  
            printf("Connect failed: %s\n", mysqli_connect_error()); 
            exit();   
        }
		self::$mysqli->set_charset("utf8");
        return self::$mysqli;     
    } 
   }
   
   function formatDate($date,$format='d/m/Y')
   {
	
	$nouvelleDate = strval($date);
	
	$tabDate=date_parse($nouvelleDate);
	
	$nouvelleDate= date($format, mktime(0,0,0,$tabDate['month'],$tabDate['day'],$tabDate['year']));
	
	return $nouvelleDate;
	
	   
	}
   
   
   
   
?>

   

    
