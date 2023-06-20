<?php
namespace App\Controller;
use App\Utils\Fonctions;
use App\Model\Utilisateur;
use App\Model\Chocoblast;
    class ChocoblastController extends Chocoblast{
        //Méthode qui va ajouter un chocoblast
        public function insertChocoblast():void{
            //Test si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                //Générer la liste déroulante cible
                $user = new Utilisateur();
                $data = $user->getUserAll($_SESSION['id']);
                //Variable pour stocker les messages d'erreur
                $msg = "";
                //Tester si le formulaire est submit
                if(isset($_POST['submit'])){
                    //Nettoyer les inputs
                    $slogan = Fonctions::cleanInput($_POST['slogan_chocoblast']);
                    $date = Fonctions::cleanInput($_POST['date_chocoblast']);
                    $cible = Fonctions::cleanInput($_POST['cible_chocoblast']);
                    //récupération des valeurs
                    $auteur = $_SESSION['id'];
                    //Test si les champs sont remplis
                    if(!empty($slogan) AND !empty($date) AND !empty($cible) 
                    AND !empty($auteur)){
                        //Setter les valeurs à l'objet
                        $this->setSloganChocoblast($slogan);
                        $this->setDateChocoblast($date);
                        $this->getCibleChocoblast()->setIdUtilisateur($cible);
                        $this->getAuteurChocoblast()->setIdUtilisateur($auteur);
                        //Tester si le chocoblast existe déja (Vérification des doublons)
                        if($this->getChocoblastByInfo()){
                            $msg = "Le chocoblast : ".$slogan." Existe déja en BDD";
                            echo '<script>
                                setTimeout(()=>{
                                    modal.style.display = "block";
                                }, 500);
                            </script>';
                        }
                        //Tester sinon il n'existe pas
                        else{
                            //Ajouter en BDD le chocoblast
                            $this->addChocoblast();
                            $msg = "Le chocoblast : ".$slogan." à été ajouté en BDD";
                            echo '<script>
                                setTimeout(()=>{
                                    modal.style.display = "block";
                                }, 500);
                            </script>';
                        }
                    }
                    //Test sinon les champs sont vides
                    else{
                        $msg = "Veuillez remplir les champs de formulaire";
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                    }
                }
                //Import de la vue
                include './App/Vue/viewAddChocoblast.php';
            }
            //Test sinon on redirige vers l'accueil
            else{
                header('Location: ./');
            }
        }
        //Méthode qui va afficher tous les chocoblasts
        public function showAllChocoblast():void{
            //valeur par défaut du tableau
            $chocos = $this->getAllChocoblast(1);
            //Tester si le formulaire est submit
            if(isset($_POST['submit'])){
                switch($_POST['filter']){
                    case 1:
                        $chocos = $this->getAllChocoblast(1);
                        break;
                    case 2:
                        $chocos = $this->getAllChocoblast(2);
                        break;
                    case 3:
                        $chocos = $this->getAllChocoblast(3);
                        break;
                    case 4:
                        $chocos = $this->getAllChocoblast(4);
                        break;
                }
            }
            //Variables pour les messages
            $msg = "";
            //Test si il existe des chocoblats
            if(!$chocos){
                $msg = "Il n'y à aucun chocoblast dans la BDD";
                echo '<script>
                    setTimeout(()=>{
                        modal.style.display = "block";
                    }, 500);
                </script>';  
            }
            //Importer la vue
            include './App/Vue/ViewShowAllChocoblast.php';
        }
        // Méthode pour supprimer un chocoblast
        public function deleteChocoblastById(): void{
            //Test si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                //Test si le paramètre id_chocoblast existe
                if(isset($_GET['id_chocoblast'])){
                    //Nettoyage du paramètre
                    $id = Fonctions::cleanInput($_GET['id_chocoblast']);
                    //Set de la valeur
                    $this->setIdChocoblast($id);
                    //Suppression du chocoblast
                    $this->deleteChocoblast();
                    //Redirection vers la page afficher 
                    header('Location: ./chocoblastAll');
                }
            }
            //Test si non connecté
            else{
                //Redirection vers la page afficher 
                header('Location: ./chocoblastAll');
            }
        }
        // Méthode pour mettre à jour un chocoblast
        public function updateChocoblastById():void{
            //Variable pour stocker les messages d'erreur
            $msg = "";
            //Générer la liste déroulante cible
            $user = new Utilisateur();
            $data = $user->getUserAll($_SESSION['id']);
            //Test si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                //Test si l'id_chocoblast existe
                if(isset($_GET['id_chocoblast'])){
                    //Nettoyer l'id_chocoblast
                    $id = Fonctions::cleanInput($_GET['id_chocoblast']);
                    //Tester si le formulaire est submit
                    if(isset($_POST['submit'])){
                        //Nettoyer les inputs du formulaire
                        $slogan = Fonctions::cleanInput($_POST['slogan_chocoblast']);
                        $date = Fonctions::cleanInput($_POST['date_chocoblast']);
                        $cible = Fonctions::cleanInput($_POST['cible_chocoblast']);
                        $auteur = Fonctions::cleanInput($_SESSION['id']);
                        //Tester si les champ du formulaire sont remplis
                        if(!empty($id) AND !empty($slogan) AND !empty($date) AND !empty($cible) AND !empty($auteur)){
                            //Setter les valeurs dans un objet
                            $this->setIdChocoblast($id);
                            $this->setSloganChocoblast($slogan);
                            $this->setDateChocoblast($date);
                            $this->getCibleChocoblast()->setIdUtilisateur($cible);
                            $this->getAuteurChocoblast()->setIdUtilisateur($auteur);
                            //Mise à jour en BDD
                            $this->updateChocoblast();
                            //Gestion de l'erreur
                            $msg = "Le chocoblast : $id à été mis à jour en BDD";
                            echo '<script>
                                setTimeout(()=>{
                                    modal.style.display = "block";
                                }, 500);
                            </script>';
                        }
                        //Tester sinon les champs ne sont pas remplis
                        else{
                            //Gestion de l'erreur
                            $msg = "Veuillez remplir les champs de formulaire";
                            echo '<script>
                                setTimeout(()=>{
                                    modal.style.display = "block";
                                }, 500);
                            </script>';
                        }
                    }
                    //Importer de la vue
                    include './App/Vue/viewUpdateChocoblast.php';
                }
                //Test si l'id_chocoblast n'existe pas
                else{
                    //Redirection vers la page afficher 
                    header('Location: ./chocoblastAll');
                }
            }
            //Test si non connecté
            else{
                //Redirection vers la page afficher 
                header('Location: ./chocoblastAll');
            }
        }

        //méthode qui retourne un json filtré
        public function showAllChocoblastJson(){
            //Importer la vue
            include './App/Vue/ViewShowAllChocoblastFilter.php';
        }
        public function chocoJson(){
             //Construction du header
             header('Access-Control-Allow-Origin: *');
             header('Access-Control-Allow-Methods: POST');
             header('Content-Type: application/json');
             header('Accept: application/json');
            if(isset($_GET['filter'])){
                $filter = $_GET['filter'];
                switch($filter){
                    case 1:
                        $chocos = $this->getAllChocoblast(1);
                        break;
                    case 2:
                        $chocos = $this->getAllChocoblast(2);
                        break;
                    case 3:
                        $chocos = $this->getAllChocoblast(3);
                        break;
                    case 4:
                        $chocos = $this->getAllChocoblast(4);
                        break;
                }
            }
            else{
                $chocos = $this->getAllChocoblast(1);
            }
            echo json_encode($chocos);
        }
    }
?>