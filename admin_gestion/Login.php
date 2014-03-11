<?php 
include_once('../include/connect.php');
static $get = array( 'TypeDeClasse' => array('Controller','Vue','Modele'),'NomDeClasse' => '', 'Methode' => '','id' =>  0);
        $on = LoginModel::EstConnecte();  $off = !$on;    
        if ($on)  {
            $params= new AdminSiteModel();$params::$id=$_SESSION['Auth']['id'];
            $params::$login=$_SESSION['Auth']['login'];$params::$pwd=$_SESSION['Auth']['pwd'];
            }
        $countGet = count($_GET);
        if (isset($_GET['XDEBUG_SESSION_START'])&&!empty($_GET['XDEBUG_SESSION_START'])) $countGet--;

        switch($countGet){
            case 0:
                if ($off) {  
                       $get['TypeDeClasse'] = 'Vue';
                       $get['NomDeClasse'] = 'Login';
                       $get['Methode'] = 'Login'; 
                       $params = NULL;
                       $countGet+=5;
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
                break;      
        }
       
    if ($countGet>2)   {  
                         $class = $get['NomDeClasse'].$get['TypeDeClasse'];
                         $body = $class::$get['Methode']($params);
                         echo $body;   
         }

class LoginController{  
    private $objLogin;  
    
    public static function Redirection(){
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
            $objlogin = LoginModel::verifierLogin($post);
            if (is_null($objlogin)) {
                    echo '<center><h2><font color="red">Erreur de login ou de mot de passe</font></h2></center>';
                    return NULL;
                    }
            if ($post['login']==''||$post['nouveaupwd']!=$post['repetenouveaupwd']){
                    echo '<center><h2><font color="orange">Le nouveau mot de passe n\'est pas bien répété</font></h2></center>';
                    echo '<meta http-equiv="refresh" content="2;URL=modifier_login.php">';
                    return NULL;
                    }    
           else {
                   // echo '<center><h2><font color="green">Les modifications ont bien été enregistrées.</font></h2></center>';
                    $error = LoginModel::Modifier($post); 
                    return $error;
           }
    }
    public static function Authentifier(array $post=null){
     
       $adminsite = LoginModel::VerifierLogin($post);        
         
       if (is_null($adminsite))  self::Redirection("Vue","Login","Login"); 
       else{   
            $_SESSION['Auth'] = array(   'id' =>   $adminsite[0],
                                         'idPersonne' => $adminsite[1],
                                         'login' => $adminsite[2],                            
                                         'pwd' =>  $adminsite[3]);                            
           return '<script type="text/javascript">window.location ="index.php"</script>';
       }
 }
 
    public static function FinSession(){
                     ob_end_clean();
                     session_unset ();
                     unset($_GET);
                     unset($get);
                     unset($_POST);
                     echo '<meta http-equiv="refresh" content="0; url=index.php">';
                    return '<script type="text/javascript">window.location ="index.php"</script>';                                              
    }
}
    
class AdminSiteModel{  
    public static $id; 
    public static $idPersonne;
    public static $login;
    public static $pwd;
}

class LoginModel { 
  
   public static function Modifier($post){  
   $rqt = 'UPDATE AdminSite SET login = "'.$post['login'].'" , pwd = "'.$post['nouveaupwd'].'" WHERE id = '.$post['id'];
                $mysqli = Connect::getInstance();
		$mysqli->query($rqt);
                $retour = $mysqli->info;
                $mysqli=null;
                if ($retour=="Rows matched: 1  Changed: 1  Warnings: 0") return true;
                else return false;
                }  
    public static function verifierLogin($post){
        $mysqli = Connect::getInstance();
        $login = $post['login'];      
        $pwd = $post['pwd'];      
        $rqt = "SELECT * FROM adminsite WHERE login='$login' AND pwd='$pwd'"; 
        $result = $mysqli->query($rqt);
        $ligne = $result->fetch_row(); 
        $mysqli = null;
        if (is_null($ligne)) return NULL;
        else return $ligne;           
    }     
    public static function EstConnecte(array $auth=null){  
       if(isset($_SESSION['Auth'])&&isset($_SESSION['Auth']['login'])&& isset($_SESSION['Auth']['pwd'])
            &&!empty($_SESSION['Auth'])&&!empty($_SESSION['Auth']['login'])&&!empty($_SESSION['Auth']['pwd']))
        { 
       print_r (AdminSiteModel::$pwd==$_SESSION['Auth']['pwd']&&AdminSiteModel::$login==$_SESSION['Auth']['login']);      
        return true;  
        }
        else return false;
        } 
}

class AdminSiteVue{
    
           public static function Menu(){            
            $content = '<li><a href="modifier_login.php">Modification Login</a></li>';   
            $content .= '<li><a href="?TypeDeClasse=Controller&NomDeClasse=Login&Methode=FinSession"/>Deconnexion</a></li>';
            return $content;
   
        }
}
class LoginVue {
 
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
        include_once ('modifier_login.php');
    }
}     
?>
