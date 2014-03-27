<?php

require_once("../include/connect.php");

class LoginModel 
	{ 
	public static $auth = array();
    public function __construct() {}
 
    public static function VerifierLogin($post)
		{
        $mysqli = Connect::getInstance();
        $login = $post['login'];
        $pwd = $post['pwd'];
      
        $rqt = "SELECT id FROM adminSite WHERE login='$login' AND pwd='$pwd'"; 
        $result = $mysqli->query($rqt);
        $taille = $result->num_rows;
		
		return $taille;
		} 
        
    public static function EstConnecte()
		{
                 
		if(isset($_SESSION['Auth'])&&isset($_SESSION['Auth']['login'])&& isset($_SESSION['Auth']['pwd'])
				&&!empty($_SESSION['Auth'])&&!empty($_SESSION['Auth']['login'])&&!empty($_SESSION['Auth']['pwd']))
			
		return true;   
			
		else return false;
    
        } 
}

?>
    