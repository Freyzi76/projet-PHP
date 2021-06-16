<?php
  session_start();
  require_once('C:/wamp64/www/bd/connexionDB.php');

    $req = $DB->query("SELECT *
      FROM categorie",
      
    );
 
    $req = $req->fetchALL();
  
    foreach($req as $r){
      ?>

        <option class="categorie" name="categorie" value="<?=$r['id']?>"><?=$r['nom']?></option>

        <?php    
    }
  
?>