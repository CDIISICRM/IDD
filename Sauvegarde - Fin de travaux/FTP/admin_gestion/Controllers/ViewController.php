<?php

require_once('Controller.Controller.php');
define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

	
        
class ViewController extends Controller{
    
	public static function Vue($vue,$mode){
            
            $controller = str_replace('Controller', '', get_class($this));
            
           
            switch($mode){
             
                case 'modeinclude' : 

                   $inc = dirname(__FILE__).''.$vue;
                    
                   include (dirname(__FILE__).''.$vue);
  
                   break;
                
                case 'modeheader' : 
                    
                    $head = "Location: ".$vue;
                    
                    header ($head);
                
                    break;
            
                case 'modemessage' : 
                    
                    header("Location : ".$vue); break;
                   
                            
                case 'modecho' :
                    
                    $ech = ROOT.''.$vue;
                    
                    echo '<script type="text/javascript">window.location = "?'.$ech.'"</script>';
                    break;
                       
                case 'modereq' :
                    // $req = ROOT.'/../view/'.$vue;
                    
                    require (ROOT.''.$vue);
                    break;
               default: header("SANS PARAMETRE"); 
            } 
        }
    
}


?>