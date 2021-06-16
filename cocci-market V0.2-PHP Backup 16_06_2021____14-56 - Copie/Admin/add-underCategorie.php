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
        if (isset($_POST['addundercategorie'])){

            $underCategorie  = htmlentities(trim($underCategorie));

 
            
            if(empty($underCategorie)){
                $valid = true;
                $er_underCategorie = ("La Sous-Catégorie ne peut étre inexistant");
            }      
            
            
 
            if($valid){

                
                                    
                $date_creation_item = date('Y-m-d H:i:s');

                // On insert nos données dans la table utilisateur
                $DB->insert("INSERT INTO  undercategorie (nom) VALUES 
                    (?)", 
                    array( $underCategorie));

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
        <title>Ajouter une Sous-Catégorie</title>
    </head>
    <body>      
        <div>Ajouter une Sous-Catégorie</div>

        <form method="post" enctype="multipart/form-data">

            <?php

             
                if (isset($er_underCategorie)){

                ?>

                
                <div><?= $er_underCategorie ?></div>
                
                <?php   
                
                }
            
            ?>

            <input type="text" placeholder="Nom de la Sous-Catégorie" name="underCategorie" value="<?php if(isset($er_underCategorie)){ echo $er_underCategorie; }?>" required>   

            
            <button type="submit" name="addundercategorie">Créer</button>


        </form>
    </body>
</html>