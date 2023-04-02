<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Utilisateur;
    class Chocoblast extends BddConnect{
        /*-----------------------
                Attributs
        ------------------------*/
        private ?int $id_chocoblast;
        private ?string $slogan_chocoblast;
        private ?string $date_chocoblast;
        private ?bool $statut_chocoblast;
        private ?Utilisateur $cible_chocoblast;
        private ?Utilisateur $auteur_chocoblast;
        /*-----------------------
                Constructeur
        ------------------------*/
        public function __construct(){
            //Instancier 2 objets Utilisateur
            $this->cible_chocoblast = new Utilisateur();
            $this->auteur_chocoblast = new Utilisateur();
            //passer le statut à true
            $this->statut_chocoblast = true;
        }
        /*-----------------------
            Getters et Setters
        ------------------------*/
        public function getIdChocoblast():?int{
            return $this->id_chocoblast;
        }
        public function getSloganChocoblast():?string{
            return $this->slogan_chocoblast;
        }
        public function getDateChocoblast():?string{
            return $this->date_chocoblast;
        }
        public function getStatutChocoblast():?bool{
            return $this->statut_chocoblast;
        }
        public function getCibleChocoblast():?Utilisateur{
            return $this->cible_chocoblast;
        }
        public function getAuteurChocoblast():?Utilisateur{
            return $this->auteur_chocoblast;
        }
        public function setIdChocoblast(?int $id):void{
            $this->id_chocoblast = $id;
        }
        public function setSloganChocoblast(?string $slogan):void{
            $this->slogan_chocoblast = $slogan;
        }
        public function setDateChocoblast(?string $date):void{
            $this->date_chocoblast = $date;
        }
        public function setStatutChocoblast(?bool $statut):void{
            $this->statut_chocoblast = $statut;
        }
        public function setCibleChocoblast(?Utilisateur $user):void{
            $this->cible_chocoblast = $user;
        }
        public function setAuteurChocoblast(?Utilisateur $user):void{
            $this->auteur_chocoblast = $user;
        }
        /*-----------------------
                Méthodes
        ------------------------*/
        //Méthode qui ajoute un chocoblast en BDD
        public function addChocoblast():void{
            try{
                //Récupérer les valeurs de l'objet
                $slogan = $this->getSloganChocoblast();
                $date = $this->getDateChocoblast();
                $statut = $this->getStatutChocoblast();
                $cible = $this->getCibleChocoblast()->getIdUtilisateur();
                $auteur = $this->getAuteurChocoblast()->getIdUtilisateur();
                //préparer la requête
                $req = $this->connexion()->prepare('INSERT INTO chocoblast(
                    slogan_chocoblast, date_chocoblast, statut_chocoblast, cible_chocoblast,
                    auteur_chocoblast) VALUES(?,?,?,?,?)');
                //Bind des paramètres
                $req->bindParam(1, $slogan, \PDO::PARAM_STR);
                $req->bindParam(2, $date, \PDO::PARAM_STR);
                $req->bindParam(3, $statut, \PDO::PARAM_BOOL);
                $req->bindParam(4, $cible, \PDO::PARAM_INT);
                $req->bindParam(5, $auteur, \PDO::PARAM_INT);
                //Exécuter la requête
                $req->execute();
            } 
            catch (\Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }
        //Méthode qui retourne un chocoblast par ces informations
        public function getChocoblastByInfo():?array{
            //Récupération des valeurs de l'objet
            $slogan = $this->getSloganChocoblast();
            $date = $this->getDateChocoblast();
            $cible = $this->getCibleChocoblast()->getIdUtilisateur();
            $auteur = $this->getAuteurChocoblast()->getIdUtilisateur();
            //Préparer la requête
            $req = $this->connexion()->prepare('SELECT id_chocoblast, slogan_chocoblast 
            FROM chocoblast WHERE slogan_chocoblast = ? AND date_chocoblast = ?
            AND cible_chocoblast = ? AND auteur_chocoblast = ?');
            //Bind des paramètres
            $req->bindParam(1, $slogan, \PDO::PARAM_STR);
            $req->bindParam(2, $date, \PDO::PARAM_STR);
            $req->bindParam(3, $cible, \PDO::PARAM_INT);
            $req->bindParam(4, $auteur, \PDO::PARAM_INT);
            //Exécution de la requête
            $req->execute();
            //Récupérer le chocoblast
            $data = $req->fetchAll(\PDO::FETCH_OBJ);
            //Retourner le tableau
            return $data;
        }
        //Méthode qui retourne tous les chocoblasts actif (statut_chocoblast = 1)
        public function getAllChocoblast(int $filter):?array{
            $requete =  '';
            if($filter == 1){
                $requete = 'SELECT id_chocoblast, slogan_chocoblast, date_chocoblast, 
                auteur.nom_utilisateur AS nom_auteur, auteur.prenom_utilisateur AS prenom_auteur,
                auteur.id_utilisateur AS id_auteur, auteur.image_utilisateur AS image_auteur,
                cible.nom_utilisateur AS nom_cible, cible.prenom_utilisateur AS prenom_cible, 
                cible.id_utilisateur AS id_cible, cible.image_utilisateur AS image_cible 
                FROM chocoblast 
                INNER JOIN utilisateur AS cible ON cible_chocoblast = cible.id_utilisateur
                INNER JOIN utilisateur AS auteur ON auteur_chocoblast = auteur.id_utilisateur
                WHERE statut_chocoblast = 1 ORDER BY date_chocoblast ASC';
            }
            elseif($filter == 2){
                $requete = 'SELECT id_chocoblast, slogan_chocoblast, date_chocoblast, 
                auteur.nom_utilisateur AS nom_auteur, auteur.prenom_utilisateur AS prenom_auteur,
                auteur.id_utilisateur AS id_auteur, 
                cible.nom_utilisateur AS nom_cible, cible.prenom_utilisateur AS prenom_cible, 
                cible.id_utilisateur AS id_cible , cible.image_utilisateur AS image_cible FROM chocoblast 
                INNER JOIN utilisateur AS cible ON cible_chocoblast = cible.id_utilisateur
                INNER JOIN utilisateur AS auteur ON auteur_chocoblast = auteur.id_utilisateur
                WHERE statut_chocoblast = 1 ORDER BY date_chocoblast DESC';
            }
            elseif($filter == 3){
                $requete = 'SELECT id_chocoblast, slogan_chocoblast, date_chocoblast, 
                auteur.nom_utilisateur AS nom_auteur, auteur.prenom_utilisateur AS prenom_auteur,
                auteur.id_utilisateur AS id_auteur, 
                cible.nom_utilisateur AS nom_cible, cible.prenom_utilisateur AS prenom_cible, 
                cible.id_utilisateur AS id_cible , cible.image_utilisateur AS image_cible 
                FROM chocoblast 
                INNER JOIN utilisateur AS cible ON cible_chocoblast = cible.id_utilisateur
                INNER JOIN utilisateur AS auteur ON auteur_chocoblast = auteur.id_utilisateur
                WHERE statut_chocoblast = 1 ORDER BY slogan_chocoblast ASC';
            }
            else{
                $requete = 'SELECT id_chocoblast, slogan_chocoblast, date_chocoblast, 
                auteur.nom_utilisateur AS nom_auteur, auteur.prenom_utilisateur AS prenom_auteur,
                auteur.id_utilisateur AS id_auteur, 
                cible.nom_utilisateur AS nom_cible, cible.prenom_utilisateur AS prenom_cible, 
                cible.id_utilisateur AS id_cible , cible.image_utilisateur AS image_cible
                FROM chocoblast 
                INNER JOIN utilisateur AS cible ON cible_chocoblast = cible.id_utilisateur
                INNER JOIN utilisateur AS auteur ON auteur_chocoblast = auteur.id_utilisateur
                WHERE statut_chocoblast = 1 ORDER BY slogan_chocoblast DESC';
            }
            //Préparer la requête
            $req = $this->connexion()->prepare($requete);
            //Exécution de la requête
            $req->execute();
            //Récupérer le chocoblast
            $data = $req->fetchAll(\PDO::FETCH_OBJ);
            //Retourner le tableau
            return $data;
        }
        //Méthode qui met à jour un chocoblast
        public function updateChocoblast():void{
            $id = $this->id_chocoblast;
            $slogan = $this->slogan_chocoblast;
            $date = $this->date_chocoblast;
            $cible = $this->getCibleChocoblast()->getIdUtilisateur();
            $auteur = $this->getAuteurChocoblast()->getIdUtilisateur();
            $req = $this->connexion()->prepare('UPDATE chocoblast 
            SET slogan_chocoblast = ?, date_chocoblast = ?, 
            cible_chocoblast = ?, auteur_chocoblast = ?
            WHERE id_chocoblast = ?');
            $req->bindParam(1, $slogan, \PDO::PARAM_STR);
            $req->bindParam(2, $date, \PDO::PARAM_STR);
            $req->bindParam(3, $cible, \PDO::PARAM_STR);
            $req->bindParam(4, $auteur, \PDO::PARAM_STR);
            $req->bindParam(5, $id, \PDO::PARAM_STR);
            $req->execute();
        }
        //Méthode qui supprime un chocoblast (passe le statut_chocoblast = 0)
        public function deleteChocoblast():void{
            $id = $this->id_chocoblast;
            $req = $this->connexion()->prepare('UPDATE chocoblast SET statut_chocoblast = 0
            WHERE id_chocoblast = ?');
            $req->bindParam(1, $id, \PDO::PARAM_INT);
            $req->execute();
        }
        //Méthode toString
        public function __toString():string{
            return $this->slogan_chocoblast;
        }
    }
?>