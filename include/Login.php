<?php //$PHP_SESSION_DISABLED = PHP_SESSION_DISABLED;//echo "PHP_SESSION_DISABLED: ".PHP_SESSION_DISABLED; $PHP_SESSION_NONE = PHP_SESSION_NONE;//echo 'PHP_SESSION_NONE: '.PHP_SESSION_NONE;
if((session_status()==PHP_SESSION_DISABLED)||(session_status()==PHP_SESSION_NONE)) session_start();//define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
   static $get = array( 'TypeDeClasse' => array('Controller','Vue','Modele'),'NomDeClasse' => '', 'Methode' => '','id' =>  0);
        $on = LoginModel::EstConnecte();  $off = !$on;
        $countPost  = count($_POST);      $countGet = count($_GET);
        if (isset($_GET['XDEBUG_SESSION_START'])&&!empty($_GET['XDEBUG_SESSION_START'])) $countGet--;
        if ($on)  {$params= new AdminSiteModel();$params::$id=$_SESSION['Auth']['id'];$params::$login=$_SESSION['Auth']['login'];$params::$pwd=$_SESSION['Auth']['pwd'];}
        switch($countGet){
            case 0:
                $get['TypeDeClasse'] = 'Vue';
                if ($off) { 
                       $get['Methode'] = 'Login'; 
                       $params = NULL;
                    }
                else {
                    $get['NomDeClasse'] = 'AdminSite';
                    $get['Methode']  = 'Menu';
                }
                break;
            case 3:
                $get['TypeDeClasse'] = $_GET['TypeDeClasse'];
                $get['NomDeClasse']  = $_GET['NomDeClasse'];
                $get['Methode']  = $_GET['Methode'];
                $params = $_POST;
                break;
            case 4:
                $get['TypeDeClasse'] = $_GET['TypeDeClasse'];
                $get['NomDeClasse']  = $_GET['NomDeClasse'];
                $get['Methode']  = $_GET['Methode']; 
                if (count($_POST)>1) $params = $_POST;
        }
        $class = $get['NomDeClasse'].$get['TypeDeClasse'];
        $body = $class::$get['Methode']($params);
        $header = LoginVue::Header();
        $footer = LoginVue::Footer();
        echo $header.$body.$footer;

class LoginController{
    
    private $objLogin ;
    
    
     protected static function Redirection(){
			$arg_list = func_get_args();
                        $count = count($arg_list);$url="";
                        switch($count){ 
                           case 4: $url = '&id='.$arg_list[3];
                           case 3: $url = '&Methode='.$arg_list[2].$url;
                           case 2: $url = '&NomDeClasse='.$arg_list[1].$url;
                           case 1: $url = '?TypeDeClasse='.$arg_list[0].$url;
                        }
			echo '<script type="text/javascript">window.location = "'.$url.'"</script>';     
                        exit();
		}
    public static function Modifier($post){              
            $objLogin = LoginModel::verifierLogin($_SESSION['Auth']);
            if($post['login']==''||$post['pwd']!=$objLogin::$pwd||$post['nouveaupwd']!=$post['repetenouveaupwd']){
                     echo "<center><strong>Les modifications n'ont pas été enregistrées.</strong></center>";
                     self::Redirection("Login","modifierLogin",$_SESSION['Auth']['id']);
            }
            $objLogin::$login = $post['login'];
            $objLogin::$pwd = $post['nouveaupwd'];
            LoginModel::Modifier($objLogin);   
            echo "<center><strong>Les modifications ont bien été enregistrées.</strong></center>";//echo '<meta http-equiv="refresh" content="2;URL=listemembre.php">';
      
    }
    public static function Authentifier(array $post=null){
       $adminsite = new AdminSiteModel();
       $adminsite = LoginModel::VerifierLogin($post);        
         
       if (is_null($adminsite))  self::Redirection("Vue","Login","Login"); 
       else{
            
               $_SESSION['Auth'] = array(
                            
                                'id' =>  $adminsite::$id,
                            
                                'login' => $adminsite::$login,
                            
                                'pwd' => $adminsite::$pwd
                                ) ;
            self::Redirection("Vue","AdminSite","Menu",$adminsite::$id);          

       }
 }
 
    public static function FinSession($id){
                     ob_end_clean();
                     session_unset ();
                     unset($_GET);
                     unset($get);
                     unset($_POST);
                     self::Redirection("Vue","Login","Login");                                              
    }
}

class Connect{
    
    private static $mysqli = null;
    private  $host='localhost';
    private  $user='root';
    private  $pass='';
    private  $base='mcdaassomag';
    
    private function __construct() {}
    
    static public final function getInstance() {
        if (is_null(self::$mysqli)){
            //      self::$mysqli=new mysqli('192.168.1.170:3306', 'mcdaassomag', 'mcdaassomag', 'mcdaassomag');
              self::$mysqli=new mysqli('localhost', 'root', '', 'mcdaassomag');
              if(self::$mysqli->connect_errno) 
              {    
                  echo "Echec de la connexion".self::$mysqli->conect_errno."  ".self::$mysqli->connect_error;
              }      
    } 
    return self::$mysqli;    
   }
 }
    
class AdminSiteModel{
    public static $id; 
    public static $idPersonne;
    public static $login;
    public static $pwd;
}

class LoginModel { 
  
   public static function Modifier($objLogin){  
		$rqt = 'UPDATE AdminSite SET login = "'.$objLogin::$login.'" , pwd = "'.$objLogin::$pwd.'" WHERE id = '.$objLogin::$id;
                $base = Connect::getInstance();
		$base->query($rqt);
                $base=null;
	}  
    public static function verifierLogin($post){
        $mysqli = Connect::getInstance();
        $login = $post['login'];      
        $pwd = $post['pwd'];      
        $rqt = "SELECT * FROM adminsite WHERE login='$login' AND pwd='$pwd'"; 
        $result = $mysqli->query($rqt);
        $ligne = $result->fetch_row(); 
        if (is_null($ligne)) return NULL;
        $adminsite = new AdminSiteModel();
        $adminsite::$id = $ligne[0];
        $adminsite::$idPersonne = $ligne[1];
        $adminsite::$login = $ligne[2];
        $adminsite::$pwd = $ligne[3];     
        $mysqli = null;      
        return $adminsite ;          
    }     
    public static function EstConnecte(array $auth=null){
         if(isset($_SESSION['Auth'])&&isset($_SESSION['Auth']['login'])&& isset($_SESSION['Auth']['pwd'])
            &&!empty($_SESSION['Auth'])&&!empty($_SESSION['Auth']['login'])&&!empty($_SESSION['Auth']['pwd']))
        return true;       
        else return false;
        } 
}

class AdminSiteVue{
    
           public static function Menu($AdminSite){
            $content = '<div id="wrap"><div id="header"><h1>M C D A</h1></div><div id="content">';
            $content .= '<div id="Menu"><h3>Menu</h3><ul>';
            $content .= '<li><a href="?TypeDeClasse=Vue&NomDeClasse=Login&Methode=Modifier&id='.$AdminSite::$id.'">Modification Login</a></li>';       //     echo '<li><a href="?controller=Roles">Roles</a></li>';      //      echo '<li><a href="?controller=Personnees">Personnes</a></li>';        //      echo '<li><a href="?controller=AdminSite&action=index">AdminSite</a></li>';
            $content .= '</ul></div><a href="?TypeDeClasse=Controller&NomDeClasse=Login&Methode=FinSession&id='.$AdminSite::$id.'"/>Deconnexion</a></div>';
            return $content;
   
        }
}
class LoginVue {
    public function __call($name, $arguments) {
        ;
    }

    private static $vue;
    
    public static function setVue($content){
        self::$vue = self::Header().$content.self::Footer();
        ViewController::Vue(self::$vue,"modemessage");
    }
    
        public static function Header(){
            $content = '<! DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
            $content .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">';
            $content .= '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head>';
            $content .= '<body>';
            return $content;
        }
        
      public static function Footer(){
             $content = '<br/><div id="footer">EN-PIED DE ACCUEIL ADMIN</div>';
             $content .= '</body></html>';
             return $content;
        }    
        
    public static function Login(){     
        $content = '<form  method="post" action="?TypeDeClasse=Controller&NomDeClasse=Login&Methode=Authentifier">';
        $content .= '<label>Login :</label><input class="post" id="login" type="text" name="login"  required="required" value="" autocomplete="off" /><br/>';
        $content .= '<label>Mot de passe :</label><input  class="post" id="pwd" type="password" name="pwd" required="required" value="" autocomplete="off" /><br/>';
        
        $content .= '<input type="submit" value="connexion"/></form>';
        return $content;
        }
    public static function FinirSession(){
         $content = "DECONNEXION FAITE";
        return $content;
         }
    public static function Modifier($AdminSite){        
        $content = '<table align="center"><caption>Modification du login</caption>';
        $content .= '<form method="post" action="?TypeDeClasse=Controller&NomDeClasse=Login&Methode=modifier&id='.$AdminSite::$id.'" name="form1" enctype="multipart/form-data">';
        $content .= '<tr><td><input type="hidden" name="id" value="'.$AdminSite::$id.'" /></td></tr>';       
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Login</font></td>';
        $content .= '<td align="left"><input type="text" name="login" value="'.$AdminSite::$login.'" size="40"  required="required" value="" autocomplete="off"/></td></tr>'; 
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Ancien Mot de passe</font></td>';     
        $content .= '<td align="left"><input type="password" name="pwd" value=\"\" size="40" required="required" value="" autocomplete="off"/></td></tr>';        
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Nouveau Mot de passe</font></td>';
        $content .= '<td align="left"><input type="password" name="nouveaupwd" value=\"\" size="40" required="required" value="" autocomplete="off"/></td></tr>';  
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Répéter le Mot de passe</font></td>';     
        $content .= '<td align="left"><input type="password" name="repetenouveaupwd" value=\"\" size="40" required="required" value="" autocomplete="off" /></td></tr>';  
        $content .= '<tr><td></td><td align="left"><input type="submit" name=\"valider\" value="modifier" />&nbsp;&nbsp;&nbsp;';
        $content .= '<input type="reset" name=\"recommencer\" value="recommencer"/></td></tr>';
        $content .= '<tr><td colspan="2"><a href="?controller=Login">Annulation</a></td></tr>';
        $content .= '</form></table>';    
       return $content;
    }       
}
?>
