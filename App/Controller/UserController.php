<?php
    namespace App\Controller;
    use App\Model\Utilisateur;
    class UserController extends Utilisateur{
        //fonction qui va gérer l'ajout d'un utilisateur en BDD
        public function insertUser(){
            //importer la vue
            include './App/Vue/viewAddUser.php';
        }
    }
?>