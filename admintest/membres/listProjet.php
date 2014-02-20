<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../header.php');
include('../modele/Modele.Projet.php');
include('../../include/connect.php');
/**
 * Description of listProjet
 *
 * @author crm
 */

    //put your code here
    $connet=Connect::getInstance();
    
    
$projet= new Projet(NULL,NULL,NULL,NULL,NULL, NULL, NULL, NULL, 0);
    
    
  //$long=$projet->ListProjet($connect, '', '');
   $long=$projet->listerTout($connect);
    
    echo '<table border="1" cellpadding="5" cellspacing="5">';

            for($i=0; $i<count($long));$i++  ){
                echo "<tr> ".$long[$i]->getPNom."<tr>
                        <tr> " .$long[$i]->getPObjectifs. " <tr>
                        <tr> " .$long[$i]->getetatActuel. " <tr>
                        <tr> " .$long[$i]->getDateDeb. " <tr>
                        <tr> " .$long[$i]->getPhoto_1. " <tr>
                        <tr> " .$long[$i]->getPhoto_2. " <tr>
                        <tr> " .$long[$i]->getDateDebut. " <tr>
                        <tr> " .$long[$i]->getDateFin. " <tr>";
            }
            echo'<td></table>';
            
     
            
?>