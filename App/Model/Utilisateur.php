<?php
    namespace App\Model;
    use App\Utils\BddConnect;
    use App\Model\Roles;
    class Utilisateur extends BddConnect{
        /*-----------------------
                Attributs
        ------------------------*/
        private ?int $id_utilisateur;
        private ?string $nom_utilisateur;
        private ?string $prenom_utilisateur;
        private ?string $mail_utilisateur;
        private ?string $password_utilisateur;
        private ?string $image_utilisateur;
        private ?bool $statut_utilisateur;
        private ?Roles $roles;
        /*-----------------------
                Constructeur
        ------------------------*/
        public function __construct(){
            //instancier un objet role quand on créé un
            $this->roles = new Roles('user');
        }
        /*-----------------------
            Getters et Setters
        ------------------------*/
        public function getIdUtilisateur():?int{
            return $this->id_utilisateur;
        }
        public function getNomUtilisateur():?string{
            return $this->nom_utilisateur;
        }
        public function getPrenomUtilisateur():?string{
            return $this->prenom_utilisateur;
        }
        public function getMailUtilisateur():?string{
            return $this->mail_utilisateur;
        }
        public function getPasswordUtilisateur():?string{
            return $this->password_utilisateur;
        }
        public function setNomUtilisateur($name):void{
            $this->nom_utilisateur = $name;
        }
        public function setPrenomUtilisateur($firstName):void{
            $this->prenom_utilisateur = $firstName;
        }
        public function setMailUtilisateur($mail):void{
            $this->mail_utilisateur = $mail;
        }
        public function setPasswordUtilisateur($pwd):void{
            $this->password_utilisateur = $pwd;
        }
        
    }

?>