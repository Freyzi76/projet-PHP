<?php
    session_start();
    include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
 
    
    if (!isset($_SESSION['id'])){
        header('Location: admin-panel.php'); 
        exit;
    }
 
    // Si la variable "$_Post" contient des informations alors on les traitres
    if(!empty($_POST)){
        extract($_FILES);
        extract($_POST);
        $valid = true;
 
        // On se place sur le bon formulaire grâce au "name" de la balise "input"
        if (isset($_POST['additem'])){

            $categorie  = htmlentities(trim($categorie));

 
            
            if(empty($categorie)){
                $valid = true;
                $er_categorie = ("Le nom ne peut étre inexistant");
            }      
            
            
 
            if($valid){

                
                                    
                $date_creation_item = date('Y-m-d H:i:s');

                // On insert nos données dans la table utilisateur
                $DB->insert("INSERT INTO categorie (nom) VALUES 
                    (?)", 
                    array($categorie));

                header('Location: admin-panel.php');
                exit;





            } else {

                header('Location: admin-panel.php');
                exit;

            }


        }
    }
?>


<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajouter une Catégorie</title>
    </head>
    <body>      
        <div>Ajouter une Catégorie</div>

        <form method="post" enctype="multipart/form-data">

            <?php

             
                if (isset($er_categorie)){

                ?>

                
                <div><?= $er_categorie ?></div>
                
                <?php   
                
                }
            
            ?>

            <input type="text" placeholder="Nom de la Catégorie" name="categorie" value="<?php if(isset($er_categorie)){ echo $er_categorie; }?>" required>   

            
            <button type="submit" name="additem">Créer</button>


        </form>
    </body>
</html>