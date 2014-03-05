<?php


    class Connect{
    
    private static $mysqli = null;
    private  $host='localhost:3306';
    private  $user='mcdaassomag';
    private  $pass='mcdaassomag';
    private  $base='mcdaassomag';
    
    private function __construct() {}

        static public final function getInstance() {
        if (is_null(self::$mysqli)){
              self::$mysqli=new mysqli("192.168.1.48:3306", "mcdaassomag", "mcdaassomag", "mcdaassomag");
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

   

    
