<?php
    session_start();
    include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
 
    
    
    if (!isset($_SESSION['id'])){
        header('Location: admin-panel.php'); 
        exit;
    }
 
    // Si la variable "$_Post" contient des informations alors on les traitres
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;
 
        // On se place sur le bon formulaire grâce au "name" de la balise "input"
        if (isset($_POST['addmenu'])){
            $menuName  = htmlentities(trim($menuName)); // On récupère le nom
            $menuCategorie  = htmlentities(trim($_POST['menu_categorie']));

            $underMenuActive = null;


            $underMenu1Name  = htmlentities(trim($underMenu1Name)); // On récupère le nom
            $underMenu1Categorie  = htmlentities(trim($_POST['underMenu1_categorie']));



            
            
            $menuImage;
            $nom;
            $extensionUpload;


            
            if(empty($menuName)){
                $valid = false;
                $er_itemName = ("Le nom ne peut étre inexistant");
            }      



            if(!empty($underMenu1Name)){
                $underMenuActive = '1';
            }  


            
            
            //if(!empty($_POST['menuImage'])) {

            
                        if (isset($_FILES['menuImage']) and !empty($_FILES['menuImage']['name'])) { // On vérifie qu'il y a bien un fichier

            
                            $filename = $_FILES['menuImage']['tmp_name']; // On récupère le nom du fichier
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
                                

            
                                if ($_FILES['menuImage']['size'] <= $tailleMax){ // Si le fichier et bien de taille inférieur ou égal à 12Mo
            
                                    $extensionUpload = strtolower(substr(strrchr($_FILES['menuImage']['name'], '.'), 1)); // Prend l'extension après le point, soit "jpg, jpeg ou png"
            
                                    if (in_array($extensionUpload, $extensionsValides)){ // Vérifie que l'extension est correct
            
                                        $dossier = '../public/menu/'; // On se place dans le dossier de la personne 
                                        

                                        

                                        if (!is_dir($dossier . $menuCategorie)){ // Si le nom de dossier n'existe pas alors on le crée

                                            mkdir($dossier . $menuCategorie );
                                        }
            
                                        
                                        $nom = md5(uniqid(rand(), true)); // Permet de générer un nom unique à la photo

                                        $menuImage = '../public/menu/' . $menuCategorie . '/' . $nom . '.' . $extensionUpload;
                                        
                                        $resultat = move_uploaded_file($_FILES['menuImage']['tmp_name'], $menuImage); // On fini par mettre la photo dans le dossier

                                        
                                        $valid = true;

                                        


                                    }



                                }


                        }


               // }

            
 
            if($valid){

                
                                    
                $date_creation_menu = date('Y-m-d H:i:s');

                // On insert nos données dans la table utilisateur
                $DB->insert("INSERT INTO menu (menuName, menuCategorie, menuImage, underMenuActive, underMenu1Name, date_creation_menu ) VALUES 
                    (?, ?, ?, ?, ?, ?)", 
                    array($menuName, $menuCategorie, $menuImage, $underMenuActive, $underMenu1Name, $date_creation_menu));

                //header('Location: admin-panel.php');
                //exit;





            } else {

               //header('Location: admin-panel.php');
               //exit;

            }


        }
    }
?>


<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ajouter un Menu</title>

        <script src="../js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/categorieSearch.js"></script>
        <script src="js/underCategorieSearch.js"></script>

    </head>
    <body>      
        <div>Ajouter un Menu</div>
        <form method="post" enctype="multipart/form-data">
            <?php
                // S'il y a une erreur sur le nom alors on affiche
                if (isset($er_menuName)){
                ?>
                    <div><?= $er_menuName ?></div>
                <?php   
                }
            ?>

            <input type="text" placeholder="Nom du Menu" name="menuName" value="<?php if(isset($er_menuName)){ echo $er_menuName; }?>" required>   



            <input id="menuImage" type="file" name="menuImage"  required/>




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


                                                <br>

            
            
            <input type="text" placeholder="Nom du Sous menu" name="underMenu1Name" value="<?php if(isset($er_menuName)){ echo $er_menuName; }?>" required>   





            <select id="underMenu1_categorie" name="underMenu1_categorie" onclick = "underCategorieSearch(2)"> 
                <optgroup label="add-categorie">
                    <option name="categorie2" value="00002" onclick="window.open('add-underCategorie.php')">
                        
                        <?php if(isset($categorie)){ echo $categorie;?> 
                            <?php 
                                }else{
                                    ?>
                                        Ajouter une Sous-Catégorie
                                            <?php
                                                }
                                                ?>
                    </option>
                 </optgroup>

                 <optgroup id="categorie2" label="categorie2">
                    
                 </optgroup>
            
                 </select>


            
            
            
 
         

                 <button type="submit" name="addmenu">Envoyer</button>
            
        </form>
    </body>
</html>