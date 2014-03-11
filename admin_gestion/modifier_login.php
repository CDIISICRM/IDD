<?php

include ('modele/Modele.DAO.php');
require_once('header.php');
//require_once('../include/connect.php'); 
require_once('modele/Modele.Presse.php');


$true = false;
       if(isset($_POST['valider'])) {
          $true = LoginController::Modifier($_POST);
     
       if($true)

	echo '<meta http-equiv="refresh" content="2;URL=index.php">';
       }
    
 if(empty($_POST['valider']) || !$true)
 {
     $AdminSite = new AdminSiteModel();
     
       $adminsite = LoginModel::VerifierLogin($_SESSION['Auth']); 
        $content = $true;
        $content .= '<table align="center"><caption>Modification du login</caption>';
        $content .= '<form method="post" action="modifier_login.php" name="form1" enctype="multipart/form-data">';
        $content .= '<tr><td><input type="hidden" name="id" value="'.$AdminSite::$id.'" /></td></tr>';       
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Login</font></td>';
        $content .= '<td align="left"><input type="text" name="login" value="'.$AdminSite::$login.'" size="40"  required="required" value="" autocomplete="off"/></td></tr>'; 
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Ancien Mot de passe</font></td>';     
        $content .= '<td align="left"><input type="password" name="pwd" size="40" required="required" value="" autocomplete="off"/></td></tr>';        
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Nouveau Mot de passe</font></td>';
        $content .= '<td align="left"><input type="password" name="nouveaupwd" size="40" required="required" value="" autocomplete="off"/></td></tr>';  
        $content .= '<tr><td align="right"><font color="#663300" face="Arial, Helvetica, sans-serif" size="+1">Répéter le Mot de passe</font></td>';     
        $content .= '<td align="left"><input type="password" name="repetenouveaupwd" size="40" required="required" value="" autocomplete="off"/></td></tr>';  
        $content .= '<tr><td></td><td align="left"><input type="submit" name="valider" value="modifier"/>';
        $content .= '<input type="reset" name=\"recommencer\" value="recommencer"/><input type="button" value="Annuler" onclick="Javascript: window.location.href=\'index.php\'"/></td></tr>';
        $content .= '</form></table>';
        echo $content;
}
            
 include('footer.php');     
    ?>
