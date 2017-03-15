<?php	
	session_start();
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
 ?>
<?php 
	include("conn.php");

	$usua = $_SESSION['id_usuarios'];
	$part = $_POST['part'];
	$jugada = $_POST['jugada'];
	$punto = $_POST['punto'];
	$fecha = date("Y-m-d H:i:s",time());




	$bpunt = "SELECT * FROM puntos WHERE id_usuarios2 = '$usua' AND puntos_acumulados >= '$punto';";
	$cpunt = mysqli_query($conn,$bpunt);
	$npunt = mysqli_num_rows($cpunt);




	if ($npunt = 1) {
		$bpart = "SELECT id_partidos,uno,dos,tres from partidos WHERE id_partidos = '$part';";
		$cpart = mysqli_query($conn,$bpart);
		$npart = mysqli_num_rows($cpart);

		$cganar = mysqli_query($conn,$bpart);
		$qganar = mysqli_fetch_array($cganar);

		$one = $qganar['uno'];
		$do = $qganar['dos'];
		$tre = $qganar['tres'];

		if ($npart = 1) {

			
			if ($jugada == 2 ) {
			$ganar = $punto*$one;
			}if ($jugada == 3 ) {
			$ganar = $punto*$do;
			}if ($jugada == 4 ) {
			$ganar = $punto*$tre;
			}

			$in = "INSERT INTO jugadas(id_usuarios1,id_partidos1,puntos_jugados,puntos_a_ganar,jugada,fecha_jugada) VALUES('".$usua."','".$part."','".$punto."','".$ganar."','".$jugada."','".$fecha."');";

			$cin = mysqli_query($conn,$in);
			if ($cin) {
				$up = "UPDATE puntos SET puntos_perdidos=puntos_perdidos+'$punto' where id_usuarios2 = '$usua';";
				$cup = mysqli_query($conn,$up);

				if ($cup) {
					header('Location: ../partido.php?partido='.$part.'');
				}

			}else {echo "error al cargar jugada";}
			
			

		}else{echo "partido no encontrado";}
		


	}else{echo "puntos insuficientes";}






	






 ?>