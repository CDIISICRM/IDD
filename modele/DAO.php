<?php

interface DAO{
    
    public function ajouter($object);
    public function modifier($object);
    public function supprimer($id);
    public function listerTout();
    public function remplir($id);


}
?>
