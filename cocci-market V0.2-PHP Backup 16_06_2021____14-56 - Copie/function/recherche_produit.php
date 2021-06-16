<?php
  session_start();
  require_once('../bd/connexionDB.php');
 
  if(isset($_GET['item'])){
    $item = (String) trim($_GET['item']);
 
    $req = $DB->query("SELECT *
      FROM item
      WHERE categorie LIKE ?",
      array("$item"));
 
    $req = $req->fetchALL();
  
    foreach($req as $r){
      ?>
      
        <div class="items">
        <img src="<?=$r['img']?>" alt="">
        <div>
            <h5><?=$r['itemname']?></h5>
            <p class="prix"><?=$r['prix']?></p>
            <p class="prixKilo" ><?=$r['prixkilo']?> <br> Le Kilo</p>
            <img class="addToCard" src="../image/add-to-cart.svg" alt="">
        </div>
        </div>
        
        <?php    
    }
  } 
?>