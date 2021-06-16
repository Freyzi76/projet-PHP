

function itemCategorieSelect(categorie) {

   var categorie;

  $(document).ready(function(){



        $.ajax({

          type: 'GET',

          url: 'function/recherche_produit.php',

          data: 'item=' + categorie,

          success: function(data){

            if(data != ""){

              $('#mainContent').append(data);

            }else{

              document.getElementById('mainContent').innerHTML = "<div>Aucun Produit</div>"

            }

          }

        });


  });

}