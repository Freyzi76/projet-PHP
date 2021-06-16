
var isActive = false;




function categorieSearch() {

  $(document).click(function(event) { 
    if(!$(event.target).closest('#categorie').length) {
      isActive = true;
    } 
  });

  if(isActive == false){
  $("option.categorie").remove();



  isActive = true;
 
         $.ajax({
 
           type: 'GET',
 
           url: 'function/recherche_categorie.php',
 
           success: function(data){
 
             if(data != ""){
 
               $('#categorie').append(data);
 
             }else{
 
               document.getElementById('categorie').innerHTML = "<option>Aucune Categorie</option>"
 
             }
 
           }
 
         });
  }else{

    isActive = false;

  }

 }