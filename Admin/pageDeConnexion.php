<?php
include("sessionPDO.php");
date_default_timezone_set('Europe/Paris');
?>

<!DOCTYPE html>
<html lang="fr" >
   <head>
       <title>Exercie Espace blog</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" type="text/css" href="../css/style.css">
   </head>
   <body>
      <div id="conteneur">
<?php

if (isset($_GET['error']) && $_GET['error'] == 1){
  echo "Oups, je n'ai pas bien compris vos identifiants, veuillez recommencer !<br/>"; 

  echo "<a href='dejaInscrit.php'>Connexion</a><br/>";
}


 // si tous les champs sont remplis :
if( (!empty($_POST['titre'])) AND (!empty($_POST['contenu'])) AND (!empty($_POST['auteur']))  ){

    try{ // test ce qui suit, essaie de se connecter à ma base de données
          $bdd = new PDO('mysql:host=localhost;dbname=blog_MVC;charset=utf8','root','root');
  
              $titre = $_POST['titre'];
              $contenu = $_POST['contenu'];
              $auteur = $_POST['auteur'];
              //$id = $_POST['id'];
              $date_creation = date("Y-m-d"); // prend naturellement la date du jour

              $sql = 'INSERT INTO articles (date_creation, titre, auteur, contenu) VALUES ("'.$date_creation.'", "'.$titre.'", "'.$auteur.'", "'.$contenu.'")';
              $requete = $bdd->query($sql);
              
        }
        catch (Exception $e){ // sinon tu affiches une erreur
                die('Erreur : ' . $e->getMessage());
        }
}

if (isset($_GET['error']) && $_GET['error'] == 2){

  /*********** Je me connecte à ma base de données *************/
    try{ // test ce qui suit, essaie de se connecter à ma base de données
          $bdd = new PDO('mysql:host=localhost;dbname=blog_MVC;charset=utf8','root','root');
        }
        catch (Exception $e){ // sinon tu affiches une erreur
                die('Erreur : ' . $e->getMessage());
        }

    $sql = 'SELECT * FROM articles ORDER BY id';
    $requete = $bdd->query($sql);

    while ($donnees = $requete->fetch()){
      echo "<div id=\"global\"><div id=\"contenu\">".$donnees['titre'] . ' <br/> ' . $donnees['contenu']."<br/></div></div>";
    }

    
?>
      <div id="global">
      <form method="post" action="pageDeConnexion.php?error=2">
          <p><input id="auteur" name="auteur" type="text" placeholder="Votre nom" required /><br /></p>
          <p><input id="titre" name="titre" type="text" placeholder="Titre" required /><br /></p>
          <textarea id="contenu" name="contenu" rows="10" cols="100" placeholder="Votre article" required></textarea><br />
          <!-- <p><input type="hidden" name="id" value="" /></p> -->
          <p><input type="submit" value="Envoyer" /></p>
      </form>
      </div>

<?php

     echo "<div id=\"global\"><p>Vous avez fini, c'est par ici ! <a href='deconnexion.php'>Déconnexion</a></p></div>";
}

if (isset($_GET['error']) && $_GET['error'] == 0){
?>
      <div id="contenu">

       
       <p>Vous avez fini, c'est par ici ! <a href="deconnexion.php">Déconnexion</a></p>

       </div>
      </div>
   </body>
</html>

<?php
}
?>

