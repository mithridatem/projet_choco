<?php
namespace App\Api;
use App\Model\Utilisateur;
use App\Utils\Fonctions;
    class ApiUser extends Utilisateur{
        //Fonction qui retourne la liste des utilisateurs en Json
        public function getAllUsersJson():void{
            //Construction du header
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Content-Type: application/json');
            //Récupération des utilisateurs
            $json = $this->getUserAll();
            //Test si il y à des utilisateurs en BDD
            if($json){
                //Génération du json
                echo json_encode($json);
            }
            //Test sinon affiche un json d'erreur
            else{
                echo json_encode(['Erreur :'=>'Aucun compte utilisateur']);
            }
        }
        //Fonction qui retourne un utilisateur depuis son id en Json
        public function getUserByIdJson():void{
            //Construction du header
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Content-Type: application/json');
            //Test si l'ID est passé en paramétre
            if(isset($_REQUEST['id'])){
                //Nettoyage et récupération de l'ID
                $this->setIdUtilisateur(Fonctions::cleanInput($_REQUEST['id']));
                //Récupération de l'utilisateurs
                $json = $this->getUserById(); 
                //Test si il y à des utilisateurs en BDD
                if($json){
                    //Génération du json
                    echo json_encode($json);
                }
                //Test sinon affiche un json d'erreur
                else{
                    echo json_encode(['Erreur :'=>'Aucun compte utilisateur']);
                }
            }
            //Test sinon il n'y à pas d'ID
            else{
                echo json_encode(['Erreur :'=>'Veuillez passser un ID']);
            }
        }
        //Fonction qui ajoute un utilisateur depuis un Json
        public function addUserByJson():void{
            //Construction du header
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST');
            header('Accept: application/json');
            //Test si la méthode est POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //récupération du json
                $json = file_get_contents("php://input");
                //Test si le json existe
                if($json != null){
                    //Décodage du json
                    $data = json_decode($json, true);
                    $this->setNomUtilisateur($data['nom']);
                    $this->setPreNomUtilisateur($data['prenom']);
                    $this->setMailUtilisateur($data['mail']);
                    $this->setPasswordUtilisateur(password_hash($data['password'], PASSWORD_DEFAULT));
                    $this->setImageUtilisateur($data['image']);
                    $this->addUser();
                    header('Access-Control-Allow-Methods: GET');
                    header('Content-Type: application/json');
                    header('HTTP/1.0 200');
                    echo json_encode(['Valid'=>'Le compte a ete ajouté']);
                }
                //Test le json n'existe pas
                else{
                    echo json_encode(['Erreur : '=>'Le json n\'existe pas']);
                }
            }
            //Test si la méthode n'est pas POST
            else{
                header('HTTP/1.0 405');
                echo json_encode(['Erreur : '=>'Le protocole est incorrect']);
            }
        }
    }
?>