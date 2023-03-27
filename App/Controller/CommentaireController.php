<?php
namespace App\Controller;
use App\Utils\Fonctions;
use App\Model\Commentaire;
    class CommentaireController extends Commentaire{
        //Méthode pour ajouter un commentaire en BDD
        public function insertCommentaire():void{
            $msg = "";
            //Tester si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                //Tester si le formulaire est submit
                if(isset($_POST['submit'])){
                    //Nettoyer les entrées
                    $note = Fonctions::cleanInput($_POST['note_commentaire']);
                    $text = Fonctions::cleanInput($_POST['text_commentaire']);
                    $date = Fonctions::cleanInput($_POST['date_commentaire']);
                    $auteur = Fonctions::cleanInput($_SESSION['id']);
                    $choco = Fonctions::cleanInput($_GET['id_chocoblast']);
                    //Tester si les champs sont remplis
                    if(!empty($note) AND !empty($text) AND !empty($date)
                    AND !empty($auteur) AND !empty($choco)){
                        //Setter les valeurs à mon objet commentaireController
                        $this->setNoteCommentaire($note);
                        $this->setTextCommentaire($text);
                        $this->setDateCommentaire($date);
                        $this->getAuteurCommentaire()->setIdUtilisateur($auteur);
                        $this->getChocoblastCommentaire()->setIdChocoblast($choco);
                        //Ajouter en BDD le commentaire
                        $this->addCommentaire();
                        $msg = "Le commentaire : du chocoblast : ".$choco." a été ajouté en BDD";
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                    }   
                    //Tester sinon les champs ne sont pas remplis
                    else{
                        $msg = "Veuillez remplir tous les champs de formulaire";
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                    }
                }
                //Importer la vue
                include './App/Vue/viewAddCommentaire.php';
            }
            //Test sinon redirection vers la affichage de tous les chocoblasts
            else{
                header('Location: ./chocoblastAll');
            }
        }
    }
?>