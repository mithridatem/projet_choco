<?php
    namespace App\Controller;
    use App\Model\Roles;
    use App\Utils\Fonctions;
    class RolesController extends Roles{
        //Fonction qui ajoute un role en BDD
        public function insertRoles():void{
            //variable pour stocker les messages d'erreurs
            $msg = "";
            //Tester si le formulaire est submit
            if(isset($_POST['submit'])){
                //Nettoyer les inputs du formulaire
                $nom = Fonctions::cleanInput($_POST['nom_roles']);
                //Tester si le champ de formulaire est rempli
                if(!empty($nom)){
                    //Setter les valeurs à l'objet
                    $this->setNomRoles($nom);
                    //Ajouter en BDD le nouveau role
                    $this->addRoles();
                    //Afficher la confirmation
                    $msg = "Le role : ".$nom." à été ajouté en BDD";
                }
                //Test si les champs sont vides
                else{
                    //afficher l'erreur
                    $msg = "Veuillez remplir les champs de formulaire";
                }
            }
            //Importer la vue
            include './App/Vue/viewAddRoles.php';
        }
    }
?>