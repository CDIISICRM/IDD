<?php

class Role implements DAO{

    private $id;
    private $nomRole;




    public function __construct($id=0, $nomRole=""){
        $this->id = $id;
        $this->nomRole = $nomRole;
    }

    public function ajouter($object) {
        
    }

    public function listerTout() {
        
    }

    public function modifier($object) {
        
    }

    public function remplir($id) {
        
    }

    public function supprimer($id) {
        $this->id = $id;
    }

}
?>
