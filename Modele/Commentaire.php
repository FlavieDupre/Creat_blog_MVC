<?php 
date_default_timezone_set('Europe/Paris');
require_once 'Modele/Modele.php';

class Commentaire extends Modele {

  // Renvoie la liste des commentaires associés à un billet
  public function getCommentaires($idBillet) {
    $sql = 'SELECT id, date_commentaire, auteur, commentaire FROM commentaires WHERE id_billet=?';
    $commentaires = $this->executerRequete($sql, array($idBillet));
    return $commentaires;

  }

  // Ajoute un commentaire dans la base
  public function ajouterCommentaire($auteur, $contenu, $idBillet) {
    $sql = 'INSERT INTO commentaires (date_commentaire, auteur, commentaire, id_billet)'
      . ' values(?, ?, ?, ?)';
    $date = date('Y-m-d');  // Récupère la date courante
    $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
  }
}