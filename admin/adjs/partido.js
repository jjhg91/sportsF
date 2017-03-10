  
  var p_jug = document.getElementById('agregarj'),
      f_jug = document.getElementById('agregar');



      p_jug.addEventListener('click',function(){
      f_jug.classList.toggle('visible');
      
      });






var p_editj = document.querySelectorAll('.editar');

for (var i = 0; i < p_editj.length; i++) {
	p_editj[i].addEventListener('click',function(){
	
	   this.nextElementSibling.classList.toggle('visible');

	});
}






var selectN = document.getElementsByTagName('select');
for (var i = 0; i < selectN.length; i++) {
    selectN[i].addEventListener('focus', function() {
        this.previousElementSibling.classList.add('activo');
    });
    selectN[i].addEventListener('blur', function() {
        var valor = document.getElementsByTagName('select')[0].selectedIndex;
        if (valor <= '0') {
            this.previousElementSibling.classList.remove('activo');
            this.previousElementSibling.classList.add('error');
        } else {
            this.previousElementSibling.classList.remove('error');
        }
    });
}
var inputN = document.getElementsByTagName('input');
for (var i = 0; i < inputN.length; i++) {
    inputN[i].addEventListener('focus', function() {
        this.previousElementSibling.classList.add('activo');
    });

    function validarNumber(u) {
        inputN[u].addEventListener('blur', function() {
            if (inputN[u].value.length == 0) {
                inputN[u].previousElementSibling.classList.remove('activo');
                inputN[u].previousElementSibling.classList.add('error');
            }
            if (inputN[u].value.length > 0) {
                inputN[u].previousElementSibling.classList.remove('error');
            }
        });
    }
    ///////DIA
    validarNumber(2);
    ///////MES
    validarNumber(3);
    ///////AÑO
    validarNumber(4);
    ///////HORA
    validarNumber(5);
    ///////MIN
    validarNumber(6);
    ///////HOME
    validarNumber(7);
    ///////EMPATE
    validarNumber(8);
    ///////VISITANTE
    validarNumber(9);
}