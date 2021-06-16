
var isActive = false;




function underCategorieSearch(id) {

  $(document).click(function(event) { 
    if(!$(event.target).closest('#categorie' + id).length) {
      isActive = true;
    } 
  });

  if(isActive == false){
  $("option.categorie" + id).remove();



  isActive = true;
 
         $.ajax({
 
           type: 'GET',
 
           url: 'function/recherche_undercategorie.php',
 
           success: function(data){
 
             if(data != ""){
 
               $('#categorie' + id).append(data);
 
             }else{
 
               document.getElementById('categorie' + id).innerHTML = "<option>Aucune Categorie</option>"
 
             }
 
           }
 
         });
  }else{

    isActive = false;

  }

 }