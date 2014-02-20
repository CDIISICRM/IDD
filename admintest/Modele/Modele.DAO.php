<?php

interface DAO{
    
    public function ajouter($mysqli);
    public function modifier($mysqli);
    public function supprimer($mysqli);
    public static function listerTout($mysqli);

    public function chercher($mysqli, $id);


}
?>
