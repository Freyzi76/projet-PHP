<?php
  session_start();
  require_once('C:/wamp64/www/bd/connexionDB.php');

    $req = $DB->query("SELECT *
      FROM menu"
      
    );
 
    $req = $req->fetchALL();
  
    foreach($req as $r){
      ?>
      
                      <li>

                        <input class="inputmenu" type="checkbox" onclick = "ActiveUnderMenu(<?=$r['id']?>)" name="menu<?=$r['id']?>" id="menu<?=$r['id']?>">

                          <label class="menu" for="menu<?=$r['id']?>">

                            <div>

                              <img class="imageRayon" src="<?=$r['menuImage']?>" alt="">

                                <p><?=$r['menuName']?></p>

                                <?php if(isset($r['underMenuActive'])){ ?>

                                  <img class="fleche" src="image/fleche.svg" alt="">

                                <?php }; ?>

                            </div>

                          </label> 

                        <?php if(isset($r['underMenuActive'])){ ?>

                          <ul class="undermenu">

                          <?php if(isset($r['underMenu1Name'])) { ?>

                            <li>
                              <div>
                                <a href="#" onclick = "itemCategorieSelect(<?=$r['underMenu1Categorie']?>)"><?=$r['underMenu1Name']?></a>
                              </div>
                            </li>

                          <?php }; ?>


                          <?php if(isset($r['underMenu2Name'])) { ?>

                          <li>
                            <div>
                              <a href="#" onclick = "itemCategorieSelect(<?=$r['underMenu2Categorie']?>)"><?=$r['underMenu2Name']?></a>
                            </div>
                          </li>

                          <?php }; ?>



                          <?php if(isset($r['underMenu3Name'])) { ?>

                          <li>
                            <div>
                              <a href="#" onclick = "itemCategorieSelect(<?=$r['underMenu3Categorie']?>)"><?=$r['underMenu3Name']?></a>
                            </div>
                          </li>

                          <?php }; ?>


                          <?php if(isset($r['underMenu4Name'])) { ?>

                          <li>
                          <div>
                            <a href="#" onclick = "itemCategorieSelect(<?=$r['underMenu4Categorie']?>)"><?=$r['underMenu4Name']?></a>
                          </div>
                          </li>

                          <?php }; ?>
                            


                          </ul>

                        <?php }; ?>


                    </li>



        <?php    
    };
  
?>