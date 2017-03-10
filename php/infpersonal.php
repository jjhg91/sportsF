<?php 
	include("conn.php");

function comprobar_formulario($variable,$mi,$ma,$permitidos){

   if (strlen($variable)<$mi || strlen($variable)>$ma){
      echo $variable . " no es valido<br>";
      return false;
   }

   //compruebo que los caracteres sean los permitidos
   for ($i=0; $i<strlen($variable); $i++){
      if (strpos($permitidos, substr($variable,$i,1))===false){
         echo $variable . " no es valido2<br>";
         return false;
      }
   }
  
   echo $variable . " es valido<br>";
   return $variable;

}



 $nombre    = comprobar_formulario($_POST['nombre'],3,10,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
 $apellido  = comprobar_formulario($_POST['apellido'],3,10,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
 $direccion = comprobar_formulario($_POST['dir'],10,20,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789');
 $postal    = comprobar_formulario($_POST['cpo'],4,8,'0123456789');
 $pais      = comprobar_formulario($_POST['pais'],1,3,'0123456789');


 if ($nombre != '' && $apellido != '' && $pais != '' /*&& $direccion != ''*/ && $postal != '') {
 	
 	function cargar_dato($variable,$intabla,$incampo,$upcampo){

 		$bn = "SELECT * FROM $intabla WHERE $incampo = '$variable';";
 		$cn = mysqli_query($conn,$bn);
 		$in = mysqli_fetch_array($cn);

 		$ccn = mysqli_query($conn,$bn);
 		$nn = mysqli_num_rows($ccn);
 		if ($nn == 1) {
 			$un = "UPDATE $usuarios SET $upcampo = '$in[0]' WHERE id_usuarios = '$_SESSION['id_usuarios']';";
 			$cun = mysqli_query($conn,$un);

 		}
 		if ($nn == 0) {
 			$in = "INSERT INTO $intabla($incampo) VALUES('$variable');";
 			$cin = mysqli_query($conn,$in);

 			$bbn = "SELECT * FROM $intabla WHERE $incampo = '$variable';";
 			$cnn = mysqli_query($conn,$bbn);
 			$iin = mysqli_fetch_array($cnn);

 			$unn = "UPDATE usuarios SET $upcampo = '$iin[0]' WHERE id_usuarios = '$_SESSION['id_usuarios']';";
 			$cunn = mysqli_query($conn,$unn);
 		}
	}

	cargar_dato($nombre,$nombre,$nombre,$id_nombre1);
	cargar_dato($apellido,$apellido,$apellido,$id_apellido1);
	//cargar_dato($direccion,$intabla,$incampo,$id_);
	cargar_dato($postal,$postal,$c_postal,$id_postal1);
	cargar_dato($pais,$pais,$pais,$id_pais1);


}else{echo 'falta completar algo';}



 
 










/*
	if (ctype_alpha($_POST['nombre'])) {
		$nombre = $_POST['nombre'];
	}
	if (ctype_alpha($_POST['apellido'])) {
		$apellido = $_POST['apellido'];
	}
	if (ctype_digit($_POST['genero'])) {
		$genero = $_POST['genero'];
	}
	if (ctype_digit($_POST['pais'])) {
		$pais = $_POST['pais'];
	}
	if (ctype_digit($_POST['cpo'])) {
		$postal = $_POST['cpo'];
	}
	if (ctype_alnum($_POST['dir'])) {
		$direccion = $_POST['dir'];
	}
	
	$natalidad = $_POST['fna'];
	


*/


 ?>