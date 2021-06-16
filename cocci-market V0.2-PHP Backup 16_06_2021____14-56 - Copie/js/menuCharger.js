function menuCharger() {

   $(document).ready(function(){
 
 
 
         $.ajax({
 
           type: 'GET',
 
           url: 'function/menu_search.php',
 
           success: function(data){
 
             if(data != ""){
 
               $('#menuinput').append(data);
 
             }else{
 
               document.getElementById('menuinput').innerHTML = "<div>Aucun menu</div>"
 
             }
 
           }
 
         });
 
 
   });
 
 }