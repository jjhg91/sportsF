<?php 
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	}else{
		echo"Esta pagina es para registrados";
		exit;
	}
	//$now = time();
	//if ($now > $_SESSION['expire']) {
	//	session_destroy();
	//	echo "su sesion a terminado";
	//	exit();
	//}
 ?>

<header>
<ul>
	<li><a href="adini.php">Inicio</a></li>
	<li><a href="deporte.php">Deporte</a></li>
	<li><a href="usuario.php">Usuario</a></li>
	<li><a href="resultado.php">Resultado</a></li>
	<li><a href="adphp/adsalir.php">Salir</a></li>
</ul>
</header>