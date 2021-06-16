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
            $itemName  = htmlentities(trim($itemName)); // On récupère le nom
            $categorie  = htmlentities(trim($_POST['menu_categorie']));
            $description = htmlentities(trim($description));
            $prix  = htmlentities(trim($prix)); // On récupère le nom
            $prixKilo = htmlentities(trim($prixKilo));
            $image;
            $nom;
            $extensionUpload;

 
            
            if(empty($itemName)){
                $valid = false;
                $er_itemName = ("Le nom ne peut étre inexistant");
            }      
            
            if(empty($categorie) || $categorie == "00002"){
                $valid = false;
                $er_categorie = ("La categorie ne peut étre inexistante");
            }
 
            
            if(empty($description)){
                $valid = false;
                $er_description = ("Le prenom d' utilisateur ne peut pas être vide");
            }       
 
            
            if(empty($prix)){
                $valid = false;
                $er_prix = ("Le nom ne peut etre inexistant");
            }       
 
            //  Vérification du prénom
            if(empty($prixKilo)){
                $valid = false;
                $er_prixKilo = ("Le prenom d' utilisateur ne peut pas être vide");
            }


            
            if (isset($_FILES['file']) and !empty($_FILES['file']['name'])) { // On vérifie qu'il y a bien un fichier

 
                $filename = $_FILES['file']['tmp_name']; // On récupère le nom du fichier
                list($width_orig, $height_orig) = getimagesize($filename); // On récupère la taille de notre fichier (l'image)
 
                
 
                    $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
                    $ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg');
                    $tailleMax = 12582912; 
                    // 2mo  = 2097152
                    // 3mo  = 3145728
                    // 4mo  = 4194304
                    // 5mo  = 5242880
                    // 7mo  = 7340032
                    // 10mo = 10485760
                    // 12mo = 12582912
                    $extensionsValides = array('jpg','jpeg','png'); // Format accepté
                    

 
                    if ($_FILES['file']['size'] <= $tailleMax){ // Si le fichier et bien de taille inférieur ou égal à 12Mo
 
                        $extensionUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1)); // Prend l'extension après le point, soit "jpg, jpeg ou png"
 
                        if (in_array($extensionUpload, $extensionsValides)){ // Vérifie que l'extension est correct
 
                            $dossier = '../public/item/'; // On se place dans le dossier de la personne 
                            

                            

                            if (!is_dir($dossier . $categorie)){ // Si le nom de dossier n'existe pas alors on le crée

                                mkdir($dossier . $categorie );
                            }
 
                            
                            $nom = md5(uniqid(rand(), true)); // Permet de générer un nom unique à la photo

                            $image = '../public/item/' . $categorie . '/' . $nom . '.' . $extensionUpload;
                            
                            $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $image); // On fini par mettre la photo dans le dossier

                            
                            $valid = true;

                               


                        }

                    }

                

            }


            
 
            if($valid){

                
                                    
                $date_creation_item = date('Y-m-d H:i:s');

                // On insert nos données dans la table utilisateur
                $DB->insert("INSERT INTO item (itemname, categorie, description, prix, prixkilo, date_creation_item, img ) VALUES 
                    (?, ?, ?, ?, ?, ?, ?)", 
                    array($itemName, $categorie, $description, $prix, $prixKilo, $date_creation_item, $image));

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

        <title>Ajouter un produit</title>

        <script src="../js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/categorieSearch.js"></script>

    </head>
    <body>      
        <div>Ajouter un produit</div>
        <form method="post" enctype="multipart/form-data">
            <?php
                // S'il y a une erreur sur le nom alors on affiche
                if (isset($er_itemName)){
                ?>
                    <div><?= $er_itemName ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Nom de l'article" name="itemName" value="<?php if(isset($er_itemName)){ echo $er_itemName; }?>" required>   






            <?php
                if (isset($categorie)){
                ?>
                    <div><?= $categorie ?></div>
                <?php   
                }
            ?>

            <select id="menu_categorie" name="menu_categorie" onclick = "categorieSearch()"> 
                <optgroup label="add-categorie">
                    <option name="categorie" value="00002" onclick="window.open('add-categorie.php')">
                        
                        <?php if(isset($categorie)){ echo $categorie;?> 
                            <?php 
                                }else{
                                    ?>
                                        Ajouter une Categorie
                                            <?php
                                                }
                                                ?>
                    </option>
                 </optgroup>

                 <optgroup id="categorie" label="categorie">
                    
                 </optgroup>


                 
            </select>
 




            <?php
                if (isset($description)){
                ?>
                    <div><?= $description ?></div>
                <?php   
                }
            ?>

            <input type="text" placeholder="Description de l'article" name="description" value="<?php if(isset($description)){ echo $description; }?>" required>  



            <?php
                if (isset($prix)){
                ?>
                    <div><?= $description ?></div>
                <?php   
                }
            ?>

            <input type="text" placeholder="Prix de l'article" name="prix" value="<?php if(isset($prix)){ echo $prix; }?>" required>  



            <?php
                if (isset($prixKilo)){
                ?>
                    <div><?= $prixKilo ?></div>
                <?php   
                }
            ?>

            <input type="text" placeholder="Prix de l'article au kilo" name="prixKilo" value="<?php if(isset($prixKilo)){ echo $prixKilo; }?>" required>  



            <input id="file" type="file" name="file"  required/>



            


            <button type="submit" name="additem">Envoyer</button>
        </form>
    </body>
</html>