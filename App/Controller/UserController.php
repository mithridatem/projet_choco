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
                    /* //version avec un objet
                    $user = new Utilisateur();
                    $user->setMailUtilisateur($mail);
                    //tester si le compte existe déja
                    if($user->getUserByMail()){
                        $msg = "Les informations sont incorrectes";
                    }
                    else{
                        //hash du mot de passe
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        //version alternative avec $this
                        $user->setNomUtilisateur($nom);
                        $user->setPrenomUtilisateur($prenom);
                        $user->setPasswordUtilisateur($password);
                        //ajout du compte en BDD
                        $user->addUser();
                        //affichage de l'erreur
                        $msg = "Le compte : ".$mail." a été ajouté en BDD";
                    } */
                    //récupérer le mail dans un objet
                    $this->setMailUtilisateur($mail);
                    //tester si le compte existe déja
                    if($this->getUserByMail()){
                        $msg = "Les informations sont incorrectes";
                    }
                    //test si le compte n'existe pas
                    else{
                        //hash du mot de passe
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        //version alternative avec $this
                        $this->setNomUtilisateur($nom);
                        $this->setPrenomUtilisateur($prenom);
                        $this->setPasswordUtilisateur($password);
                        //ajout du compte en BDD
                        $this->addUser();
                        //affichage de l'erreur
                        $msg = "Le compte : ".$mail." a été ajouté en BDD";
                    }
                }
                //sinon si les champs ne sont pas tous remplis
                else{
                    $msg = "Veuillez remplir tous les champs du formulaire";
                }
            }
            //importer la vue
            include './App/Vue/viewAddUser.php';
        }
        //Fonction pour se connecter au site
        public function connexionUser(){
            //variable pour stocker les messages d'erreurs
            $msg = "";
            $valide = "";
            //Tester si le formulaire est submit
            if(isset($_POST['submit'])){
                //Nettoyer les inputs utilisateur
                $mail = Fonctions::cleanInput($_POST['mail_utilisateur']); 
                $password = Fonctions::cleanInput($_POST['password_utilisateur']);
                //Tester si les champs sont remplis
                if(!empty($mail) AND !empty($password)){
                    //Setter les valeurs à l'objet
                    $this->setMailUtilisateur($mail);
                    $this->setPasswordUtilisateur($password);
                    //Stokage du compte si il existe
                    $data = $this->getUserByMail();
                    //Tester si le compte existe
                    if($data){
                        //Test si le mot de passe est valide
                        if(password_verify($password, $data[0]->password_utilisateur)){
                            //Créer les super globales de Session
                            $_SESSION['connected'] = true;
                            $_SESSION['nom'] = $data[0]->nom_utilisateur;
                            $_SESSION['prenom'] = $data[0]->prenom_utilisateur;
                            $_SESSION['mail'] = $data[0]->mail_utilisateur;
                            $_SESSION['id'] = $data[0]->id_utilisateur;
                            $valide ="connecté";
                        }
                        //Test si le mot de passe est incorrect
                        else{
                            $msg = "Les informations de connexion sont invalides";
                        }
                    }
                    //Test si le compte n'existe pas
                    else{
                        $msg = "Les informations de connexion sont invalides";
                    }
                }
                //Test les champs sont vides
                else{
                    $msg = "Veuillez remplir tous les champs de formulaire";
                } 
            }
            //import de la vue connexion
            include './App/Vue/ViewConnexion.php';
        }
        public function deconnexionUser(){
            //Détruire la session
            session_destroy();
            //Rediriger vers la page d'accueil
            header('Location: ./');
        } 
    }
?>