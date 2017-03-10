$(document).ready(function(){
var menu = 0;
$(".prueba").click(function() {
  if(menu === 0){
    menu = 1;
   $(".contenedor-formulario").css({
  "width": "100%",
  "color": "#f2f2f2",
  "padding": "50px",
  "overflow": "visible"

  });
  }else {
    menu = 0;
    $(".contenedor-formulario").css({
      "width": "0",
      "padding": "0",
      "overflow": "hidden"
  });
  }
});
});

