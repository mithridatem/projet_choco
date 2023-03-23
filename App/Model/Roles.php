<?php
    namespace App\Model;
    use App\Utils\BddConnect;
    class Roles extends BddConnect{
        /*-----------------------
                Attributs
        ------------------------*/
        private $id_roles;
        private $nom_roles;
        /*-----------------------
                Constructeur
        ------------------------*/
        public function __construct(){
        }
        /*-----------------------
            Getter et Setters
        ------------------------*/
        public function getIdRoles():?int{
            return $this->id_roles;
        }
        public function getNomRoles():?string{
            return $this->nom_roles;
        }
        public function setNomRoles($name):void{
            $this->nom_roles = $name;
        }
        /*-----------------------
                Méthodes
        ------------------------*/
        public function addRoles():void{
            //Gestion de la requête SQL
            try {
                //Récupération des valeurs de l'objet
                $nom = $this->nom_roles;
                //Préparer la requête
                $req = $this->connexion()->prepare('INSERT INTO roles(nom_roles)
                VALUES(?)');
                //Bind le paramètre
                $req->bindParam(1, $nom, \PDO::PARAM_STR);
                //Exécuter la requête
                $req->execute();
            }
            //Gestion des exceptions
            catch (\Exception $e) {
                die('Erreur !: '.$e->getMessage());
            }
        }
    }
?>