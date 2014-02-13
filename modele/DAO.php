<?php

interface DAO{
    
    public function ajouter();
    public function modifier();
    public function supprimer();
    public function listerTout();
    public function chercher(int $id);


}
?>
