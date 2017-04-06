<?php

require_once 'Modele/Modele.php';

class Billet extends Modele {

  // Renvoie la liste de tous les billets, triés par identifiant décroissant
  public function getBillets() {
 
      $sql = 'SELECT id, titre, contenu, auteur, date_creation FROM articles ORDER BY id DESC';
     $billets = $this->executerRequete($sql);
    return $billets;
  }

  // Renvoie les informations sur un billet
  public function getBillet($idBillet) {
    $sql = 'SELECT id, date_creation, titre, contenu FROM articles WHERE id=?';
    $billet = $this->executerRequete($sql, array($idBillet));
    if ($billet->rowCount() == 1)
      return $billet->fetch();  // Accès à la première ligne de résultat
    else
      throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }
}