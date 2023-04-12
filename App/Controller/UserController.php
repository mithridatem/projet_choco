<?php
    namespace App\Controller;
    use App\Model\Utilisateur;
    use App\Utils\Fonctions;
    class UserController extends Utilisateur{
        //fonction qui va gérer l'ajout d'un utilisateur en BDD
        public function insertUser(){
            //variable pour stocker les messages d'erreurs
            $msg = "";
            /*-------------------------------
                        logique 
            --------------------------------*/
            //test si le bouton est cliqué 
            if(isset($_POST['submit'])){
                //récupération et nettoyage des inputs utilisateurs
                $nom = Fonctions::cleanInput($_POST['nom_utilisateur']);
                $prenom = Fonctions::cleanInput($_POST['prenom_utilisateur']);
                $mail = Fonctions::cleanInput($_POST['mail_utilisateur']);
                $password = Fonctions::cleanInput($_POST['password_utilisateur']);
                //tester si les champs sont remplis
                if(!empty($nom) AND !empty($prenom)AND !empty($mail) AND !empty($password)){
                    //hash du mot de passe
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    //instance d'un objet
                    /* $user = new Utilisateur();
                    $user->setNomUtilisateur($nom);
                    $user->setPrenomUtilisateur($prenom);
                    $user->setMailUtilisateur($mail);
                    $user->setPasswordUtilisateur($password);
                    echo '<pre>';
                    var_dump($user);
                    echo '</pre>';
                    $user->addUser(); */
                    //version alternative avec $this
                    $this->setNomUtilisateur($nom);
                    $this->setPrenomUtilisateur($prenom);
                    $this->setMailUtilisateur($mail);
                    $this->setPasswordUtilisateur($password);
                    /* echo '<pre>';
                    var_dump($this);
                    echo '</pre>'; */
                    $this->addUser();
                    $msg = "Le compte : ".$mail." a été ajouté en BDD";
                }
                //sinon si les champs ne sont pas tous remplis
                else{
                    $msg = "Veuillez remplir tous les champs du formulaire";
                }
            }
            //importer la vue
            include './App/Vue/viewAddUser.php';
        }
    }
?>