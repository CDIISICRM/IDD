<?php
require_once('Controller.Controller.php');
require_once("ViewController.php");
// require_once("model/LoginModel.php");

class LoginController extends Controller 
	{
    public function __construct()
		{
        //  self::viewcontroller  ViewController($this);    
        //= new ViewController() ; //=  new ViewController();
		}
    
	public function index()
		{			
        // ViewController::vue('../'.__FUNCTION__.'.php','modeinclude');               	
		}

    
    public static function SessionStart($post)
		{  
        if (LoginModel::EstConnecte()) 
			return true;
        
		if (self::DemandeConnection($post)) 
			{
			$connectionouverte = self::OuvrirSession($post);
            if ($connectionouverte) 
				return true;
               
            $count = 0;
            return true;
			}
		else 
			{
            return false;
			}
		}
         
	public static function DemandeConnection(array $post=null)
		{
		if (count($post)>2 ) 
			return true;
		else 
			return false;
		}
	
	 public static function OuvrirSession($post)
		{
		$taille = LoginModel::VerifierLogin($post);
		
		if ($taille<1) 
			return false;
		else
			{   
			$_SESSION['Auth'] = array
				(
				'login' =>  $post['login'],
				'pwd' => $post['pwd'],
				'id' => rand(1,999)
				);
					
			return true;
			}
		}

	public static function FermerSession()
		{
		unset($_SESSION);
		}
	}
