<?php
namespace App\Controller;
use App\Utils\Fonctions;
use App\Model\Utilisateur;
use App\Model\Chocoblast;
    class ChocoblastController extends Chocoblast{
        //Méthode qui va ajouter un chocoblast
        public function inserChocoblast():void{
            //Test si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                //Générer la liste déroulante
                $data = Utilisateur::getUserAll();
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
                        //Ajouter en BDD le chocoblast
                        $this->addChocoblast();
                        $msg = "Le chocoblast : '.$slogan.' à été ajouté en BDD";
                    }
                    //Test sinon les champs sont vides
                    else{
                        $msg = "Veuillez remplir les champs de formulaire";
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
    }
?>