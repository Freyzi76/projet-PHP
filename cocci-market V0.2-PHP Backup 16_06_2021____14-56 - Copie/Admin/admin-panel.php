<?php

  // Permet de savoir s'il y a une session. 

  // C'est-à-dire si un utilisateur s'est connecté à votre site 

  session_start(); 

  

  // Fichier PHP contenant la connexion à votre BDD

  include('../bd/connexionDB.php'); 

?>

<html>

  <head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <title>Accueil</title>


    <script src="js/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  </head>

  <body>

    <h1>Admin panel</h1>

    <?php

      if(!isset($_SESSION['id'])){ // Si on ne détecte pas de session alors on verra les liens ci-dessous

    ?>

      <a href="connexion-admin.php">Connexion</a>

      <a href="motdepasse.php">Mot de passe oublié</a>

    <?php

        }else{ // Sinon s'il y a une session alors on verra les liens ci-dessous

    ?>

      <a href="modifier-profil.php">Modifier mon profil</a>

      <a href="deconnexion.php">Déconnexion</a>

      <br>
      <br>

      <a href="add-item.php">Ajouter un produit</a>

      <br>
      <br>

      <a href="add-categorie.php">Ajouter une categorie</a>

      <br>
      <br>

      <a href="add-underCategorie.php">Ajouter une Sous-Catégorie</a>

      <br>
      <br>

      <a href="add-menu.php">Ajouter un Menu</a>
 

    <?php
        
      } 

    ?>

  </body>

</html>