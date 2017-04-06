<?php
include("sessionPDO.php");

date_default_timezone_set('Europe/Paris');


/*********** Je me connecte à ma base de données *************/
try{ // test ce qui suit, essaie de se connecter à ma base de données
      $bdd = new PDO('mysql:host=localhost;dbname=blog_mvc;charset=utf8','root','root');
    }
    catch (Exception $e){ // sinon tu affiches une erreur
            die('Erreur : ' . $e->getMessage());
    }

/**************** Je vérifie mes champs de saisies *************/
if(!empty($_POST)){ // on vérifie qu'il y a bien des variables "post"
  
  if(!empty($_POST['loginInscrit']) AND !empty($_POST['passwordInscrit'])){ // vérifie que les variables ne sont pas vides
    $loginInscrit = $_POST['loginInscrit']; // transforme mes noms de variables
    $passwordInscrit = $_POST['passwordInscrit'];
    $date_connexion = date("Y-m-d"); // prend naturellement la date du jour
  }      

/************** Je vérifie si login existe *******************/
  $queryCorrespondance=$bdd->prepare('SELECT COUNT(*) AS nbr FROM utilisateurs WHERE login =:loginInscrit AND password =:passwordInscrit'); 
  $queryCorrespondance->bindParam(':loginInscrit',$loginInscrit, PDO::PARAM_STR); // Lie un paramètre à un nom de variable spécifique 
                                                              // PDO::PARAM_STR (entier) : Représente les types de données CHAR, VARCHAR
  $queryCorrespondance->bindParam(':passwordInscrit',$passwordInscrit, PDO::PARAM_STR);
  $queryCorrespondance->execute();
  $Correspondance_exist = $queryCorrespondance->fetch(); // mon $query devient un tableau [nbr] où il a lu 1 ou 0 fois le login
  // $verif correspond au contrôle : 1 => erreur / 0 => tout bon
  $verifCorrespondance=1; // j'initialise mon $verif à 1

  // si le login n'existe pas :

  if($Correspondance_exist['nbr'] == 0){ // si on dénombre 0 fois le login saisi...
    header("Location: pageDeConnexion.php?error=1");
    $verifCorrespondance = 0; // donc mon $verif devient 1 (erreur)
  } 

  // si toutes les conditions précédentes sont OK et que le login correspond bien au password dans ma bdd :
  if ( $verifCorrespondance==1 ){ 
  $sql = 'INSERT INTO connexion (date_connexion, utilisateur) VALUES ("'.$date_connexion.'", "'.$loginInscrit.'")';
  $requete = $bdd->query($sql);
  $_SESSION['loginInscrit'] = $loginInscrit;
    header("Location: pageDeConnexion.php?error=0");
  }

  if ($loginInscrit == "flavie.dupre@outlook.fr"){
    header("Location: pageDeConnexion.php?error=2");
  }
}      

?>


<!DOCTYPE html>
<html lang="fr" >
   <head>
       <title>Exercie Blog</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" type="text/css" href="../css/style.css">
   </head>
   <body>
      <div id="global">


      <div id="contenu">

		  <p>Vous êtes déjà inscrit :</p>
       <form action="dejaInscrit.php" method="post">

          <p>
              <label>Login</label>
              <input type="text" name="loginInscrit" value="<?php if (isset($loginInscrit)) echo $loginInscrit ; ?>" placeholder=" Adresse @mail" required/>            
          </p>

          <p>
              <label>Mot de passe</label>
              <input type="password" name="passwordInscrit" value="<?php if (isset($passwordInscrit)) echo $passwordInscrit ; ?>" placeholder=" Minimum 6 caractères" required/>            
          </p>
      
            <input type="submit" value="Connexion" /> 
       </form>


       </div>
      </div>
   </body>
</html>

