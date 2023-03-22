<?php
    namespace App\Utils;
    class BddConnect{
        //fonction connexion BDD
        public function connexion(){
            return new \PDO('mysql:host=localhost;dbname=chocoblast', 'root','', 
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
    }
?>
