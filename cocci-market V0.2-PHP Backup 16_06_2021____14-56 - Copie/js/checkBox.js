

var flecheDesactive = 0 + "deg";
var flecheActive = 180 + "deg";


var secondMenuPaddingTopPX = "28px"


var MenuActive;



var numberOfMenu = document.querySelectorAll("input.inputmenu").length;

//>inutile
var MenuList = document.querySelectorAll("input.inputmenu");
//>inutile


var flecheMenuList = document.querySelectorAll("img.fleche");
var underMenuList = document.querySelectorAll("ul.undermenu");



function ActiveUnderMenu(menuId) {

    


    
    if(MenuActive != menuId){

        MenuActive =  menuId;

        var numberFlecheMenuSelectActivation = flecheMenuList[menuId];
        var underMenuSelectActivation = underMenuList[menuId];


        numberFlecheMenuSelectActivation.style.rotate = flecheActive;
        underMenuSelectActivation.style.display = "block"; 


    } else {

        var numberFlecheMenuSelectActivation = flecheMenuList[menuId];
        var underMenuSelectActivation = underMenuList[menuId];


         numberFlecheMenuSelectActivation.style.rotate = flecheDesactive;
         underMenuSelectActivation.style.display = "none"; 

         MenuActive = 99;


           }

                    


        for (let menuNumberClose = 0; menuNumberClose < test; menuNumberClose++) {

            if(menuNumberClose != menuId) {

            closeOtherMenu(menuNumberClose);

            } 

       }


};

      



function closeOtherMenu(menuNumber) {




    var numberFlecheMenuSelectDesactive = flecheMenuList[menuNumber];
    var underMenuSelectDesactive = underMenuList[menuNumber];


    numberFlecheMenuSelectDesactive.style.rotate = flecheDesactive;
    underMenuSelectDesactive.style.display = "none"; 



};






