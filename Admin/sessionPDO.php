<?php
session_start();

if ( isset($_SESSION['loginInscrit']) && !empty($_SESSION['loginInscrit']) && isset($_SESSION['passwordInscrit']) && !empty($_SESSION['passwordInscrit']) ) {

      // je crée une variable qui récupère les données pour ma page
    $sess_passwordInscrit = $_SESSION['passwordInscrit'];
}

?>