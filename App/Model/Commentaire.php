<?php
namespace App\Model;
//import des classes
use App\Utils\BddConnect;
use App\Model\Chocoblast;
use App\Model\Utilisateur;
    class Commentaire extends BddConnect{
        /*-------------------------------
                    Attributs
        -------------------------------*/
        private ?int $id_commentaire;
        private ?int $note_commentaire;
        private ?string $text_commentaire;
        private ?string $date_commentaire;
        private ?bool $statut_commentaire;
        private ?Chocoblast $id_chocoblast;
        private ?Utilisateur $auteur_commentaire;
        /*-------------------------------
                    Constructeur
        -------------------------------*/
        public function __construct(){
            $this->id_chocoblast = new Chocoblast();
            $this->auteur_commentaire = new Utilisateur();
            $this->statut_commentaire = true;
        }
        /*-------------------------------
                Getter et Setter
        --------------------------------*/
        public function getIdCommentaire():?int{
            return $this->id_commentaire;
        }
        public function getNoteCommentaire():?int{
            return $this->note_commentaire;
        }
        public function getTextCommentaire():?string{
            return $this->text_commentaire;
        }
        public function getDateCommentaire():?string{
            return $this->date_commentaire;
        }
        public function getStatutCommentaire():?bool{
            return $this->statut_commentaire;
        }
        public function getChocoblastCommentaire():?Chocoblast{
            return $this->id_chocoblast;
        }
        public function getAuteurCommentaire():?Utilisateur{
            return $this->auteur_commentaire;
        }
        public function setIdCommentaire(?int $id):void{
            $this->id_commentaire = $id;
        }
        public function setNoteCommentaire(?int $note):void{
            $this->note_commentaire = $note;
        }
        public function setTextCommentaire(?string $text):void{
            $this->text_commentaire = $text;
        }
        public function setDateCommentaire(?string $date):void{
            $this->date_commentaire = $date;
        }
        public function setStatutCommentaire(?bool $statut):void{
            $this->statut_commentaire = $statut;
        }
        public function setChocoblastCommentaire(?Chocoblast $choco):void{
            $this->id_chocoblast = $choco;
        }
        public function setAuteurCommentaire(?Utilisateur $auteur):void{
            $this->auteur_commentaire = $auteur;
        }
        /*-------------------------------
                    Méthodes
        --------------------------------*/
    }
?>