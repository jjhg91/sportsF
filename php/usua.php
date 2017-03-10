<?php 	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	}
	else{
		echo"Esta pagina es para registrados";
		exit;
	}
	//$now = time();
	//if ($now > $_SESSION['expire']) {
	//	session_destroy();
	//	echo "su sesion a terminado";
	//	exit();
	//}

include("conn.php");
	$bus = "SELECT usuario,foto,banner,puntos_acumulados FROM usuarios 
	inner join puntos on puntos.id_usuarios2=usuarios.id_usuarios
	WHERE id_usuarios = '$_SESSION[id_usuarios]';";
	$pre = mysqli_query($conn,$bus);
	$roo = mysqli_fetch_array($pre);

	//$name = echo $roo['nombre'].' '.$roo['apellido'];

 ?>