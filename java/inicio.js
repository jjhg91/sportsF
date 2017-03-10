$(document).ready(function(){
var menu = 0;
$(".icon-menu").click(function() {
  if(menu === 0){
    menu = 1;
  $(".cont").css({
    
    "margin-left":"16%"
  });
   $("nav").css({
    "width": "0%",
     "overflow": "hidden"
  });
   $(".publi").css({
    "width": "83%",
    "margin-left":"16%"
  });
  
  }else {
    menu = 0;
    $(".cont").css({
    
    "margin-left":"16%"
  });
    $("nav").css({
    "width": "15%",
    "height": "100%"
  });
    $(".publi").css({
    "width": "83%",
    "margin-left":"16%"
  });
  }
});
});