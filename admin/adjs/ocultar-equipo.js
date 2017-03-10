  
  var p_agre = document.getElementById('agregare'),
      f_agre = document.getElementById('agregar');



      p_agre.addEventListener('click',function(){
      f_agre.classList.toggle('visible');

      });






var p_edit = document.querySelectorAll('.editar');

for (var i = 0; i < p_edit.length; i++) {
	p_edit[i].addEventListener('click',function(){
	
	   this.nextElementSibling.classList.toggle('visible');

	});
}