<?php


	class ConnectToDb {
            private $mysqli;
            public function __construct() {
                $this->mysqli = new mysqli("192.168.1.170:3306", "mcdaassomag", "mcdaassomag", "mcdaassomag");

                if ($this->mysqli->connect_errno) {
                    echo "Echec lors de la connexion à MySQL : (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
                }
                else
					$this->mysqli->query("SET CHARACTER SET UTF8");
                
                
            }
            
            public function getConnect(){
                return $this->mysqli;
            }

}
?>