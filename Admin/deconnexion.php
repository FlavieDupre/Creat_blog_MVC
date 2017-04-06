<?php
// cette page détruit les variables de session et redirige vers la page dejaInscrit
session_start();
unset($_SESSION);  // détruit toutes les variables de session
session_destroy();


header("Location: ../index.php");

?>
