<?php  
include("../../php/conn.php");


$deport = $_POST['deporte'];
$error = $_FILES['imagend']['error'];
$nombre = $_FILES['imagend']['name'];
$tipo = $_FILES['imagend']['type'];
$tamano = $_FILES['imagend']['size'];
$ruta ='imagenes/'.$nombre;
/*$prueba = explode('image/', $tipo);
$id = $_SESSION['id_usuarios'];
$rename = '../imagenes/'.$id.'.'.$prueba[1];*/



$ql = "SELECT deportes,foto_d from deportes WHERE deportes = '$deport' and foto_d = '$nombre';";
$qql = mysqli_query($conn,$ql);
$prueba=mysqli_num_rows($qql);



$in = "INSERT INTO deportes(deportes,foto_d) VALUES('".$deport."','".$nombre."');";


if ($prueba > 0){
echo 'ya regitro';}
elseif ($error > 0) {
		echo 'hay error';
	}
	else{
		$permitido= array('image/jpg','image/jpeg','image/gif','image/png');
		$limite_kb= 100;
		if (in_array($tipo,$permitido) && $tamano <= $limite_kb * 1024) {
			if(!file_exists($nombre)){
				$subir = mysqli_query($conn,$in) or die (print_r(sqlsrv_errors(), true));
				$resultado = move_uploaded_file($_FILES['imagend']['tmp_name'],$ruta);
				if($subir && $resultado = true ){
					header('Location: ../deporte.php');

				}
				else{ echo'no se envio';
				}
			}
			else{
				echo 'este archivo existe';
			}
		}
		else{echo ' archivo no permitido o muy grande';
		}

	}
		

?>