<?php $titre = "Mon Blog - " . $billet['titre']; ?>

<article>
  <header>
    <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
    <time><?= $billet['date_creation'] ?></time>
  </header>
  <p><?= $billet['contenu'] ?></p>
</article>
<hr />
<header>
  <h1 id="titreReponses">Réponses à <?= $billet['titre'] ?></h1>
</header>

<?php foreach ($commentaires as $commentaire){ ?>
  <p><?= $commentaire['auteur'] ?> dit :</p>
  <p><?= $commentaire['commentaire'] ?></p>
<?php 
	} 
?>

<form method="post" action="index.php?action=commenter">
    <p><input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br /></p>
    <textarea id="txtCommentaire" name="contenu" rows="10" cols="100" 
              placeholder="Votre commentaire" required></textarea><br />
    <p><input type="hidden" name="id" value="<?= $billet['id'] ?>" /></p>
    <p><input type="submit" value="Commenter" /></p>
</form>
