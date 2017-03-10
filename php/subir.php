<?php	
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	}
	else{
		echo"Esta pagina es para registrados";
		exit;
	}
	$now = time();
	if ($now > $_SESSION['expire']) {
		session_destroy();
		echo "su sesion a terminado";
		exit();
	}
 ?>
 <?php
 include('conn.php');

 //  --PERFIL-- 
$error = $_FILES['imagen']['error'];
$nombre = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
$ruta ='../imagenes/perfil/';
$prueba = explode('image/', $tipo);
$id = $_SESSION['id_usuarios'];
$rename = 'p_'.$id.'.jpeg';
$temporal = $_FILES['imagen']['tmp_name'];


if ($nombre != '') {
	if ($error > 0) {
		echo 'hay error en el perfil';
	}else{
		$permitido= array('image/jpg','image/jpeg','image/gif','image/png');
		$limite_kb= 2000;
		if (in_array($tipo,$permitido) && $tamano <= $limite_kb * 1024) {
			if ($array= glob($ruta.'p_'.$id.'*')) {
				unlink($array[0]);
			}
			
			if ($tipo == 'image/jpeg' ) {
				$original = imagecreatefromjpeg($temporal);

			}elseif ($tipo == 'image/png') {
				$original = imagecreatefrompng($temporal);
			}elseif ($tipo == 'image/gif') {
				$original = imagecreatefromgif($temporal);
			}

			$ancho_original = imagesx($original); 
			$alto_original = imagesy($original);
			$copia = imagecreatetruecolor(200,200);


			imagecopyresampled($copia,$original,0,0,0,0,200,200,$ancho_original,$alto_original);

			$resultado = imagejpeg($copia,$ruta.$rename,70);

			imagedestroy($original);
			imagedestroy($copia);

			if($resultado = true){
				$uperfil = "UPDATE usuarios SET foto = '$rename' WHERE id_usuarios = '$id';";
				$cperfil = mysqli_query($conn,$uperfil);
				if ($cperfil) {
					echo 'perfil cargada en bd ';
				}else{ echo 'error al cargar perfil bd';}

				echo 'el perfil ha sido enviado';
			}
			else{ echo'no se envio el perfil';
			}
			
			
		}
		else{echo ' perfil no permitido o muy grande';
		}

	}
}


//   --BANNER-- 
$berror = $_FILES['banner']['error'];
$bnombre = $_FILES['banner']['name'];
$btipo = $_FILES['banner']['type'];
$btamano = $_FILES['banner']['size'];
$bruta ='../imagenes/banner/';
$bprueba = explode('image/', $btipo);
$bid = $_SESSION['id_usuarios'];
$brename = 'b_'.$bid.'.jpeg';
$btemporal = $_FILES['banner']['tmp_name'];

if ($bnombre != '') {
	if ($berror > 0) {
		echo 'hay error en el banner';
	}else{
		$bpermitido= array('image/jpg','image/jpeg','image/gif','image/png');
		$blimite_kb= 2000;
		if (in_array($btipo,$bpermitido) && $btamano <= $blimite_kb * 1024) {
			if ($barray= glob($bruta.'p_'.$bid.'*')) {
				unlink($barray[0]);
			}
			
			if ($btipo == 'image/jpeg' ) {
				$boriginal = imagecreatefromjpeg($btemporal);

			}elseif ($btipo == 'image/png') {
				$boriginal = imagecreatefrompng($btemporal);
			}elseif ($btipo == 'image/gif') {
				$boriginal = imagecreatefromgif($btemporal);
			}

			$bancho_original = imagesx($boriginal); 
			$balto_original = imagesy($boriginal);
			$bcopia = imagecreatetruecolor(900,180);

			imagecopyresampled($bcopia,$boriginal,0,0,0,0,900,180,$bancho_original,$balto_original);

			$bresultado = imagejpeg($bcopia,$bruta.$brename,70);

			imagedestroy($boriginal);
			imagedestroy($bcopia);

			if($bresultado = true){
				$ubanner = "UPDATE usuarios SET banner = '$brename' WHERE id_usuarios = '$bid';";
				$cbanner = mysqli_query($conn,$ubanner);
				if ($cbanner) {
					echo 'banner cargada en bd ';
				}else{ echo 'error al cargar banner bd';}

				echo 'el banner ha sido enviado';
			}
			else{ echo'no se envio el banner';
			}
			
			
		}
		else{echo ' banner no permitido o muy grande';
		}

	}
}



//   --DEPORTE FAVORITO--




if ($_POST['deportef'] !== '') {
	$deportef = $_POST['deportef'];
	$dfid=$_SESSION['id_usuarios'];

	$qdf=$conn->query("SELECT id_usuarios4 FROM deporte_favorito WHERE id_usuarios4=$dfid;");
	$ndf=$qdf->num_rows;
		if ($ndf === 0) {
		$qdf=$conn->query("INSERT INTO deporte_favorito(id_usuarios4,id_deportes2) VALUES($dfid,$deportef);");

	if ($qdf = true) {
		echo'Agregado';
	}
	}elseif($ndf===1){
	$adf=$conn->query("UPDATE deporte_favorito SET id_deportes2=$deportef WHERE id_usuarios4=$dfid;");
	if ($adf = true) {
		echo'Actualizado';
	}
	


}

}


 ?>