<?php 
	include("../../php/conn.php");

	$partido = $_POST['partido'];
	

	$puntuacion_h = $_POST['resultado_h'];
	$puntuacion_v = $_POST['resultado_v'];



	$upd = "UPDATE partidos SET puntuacion_h = '$puntuacion_h', puntuacion_v='$puntuacion_v', actualizado='2'  WHERE id_partidos = '$partido' AND actualizado= 1;";

	$cupd = mysqli_query($conn,$upd);

	if($cupd){
		
		if ($puntuacion_h > $puntuacion_v) {
			$resultado = 2;
		}elseif($puntuacion_h === $puntuacion_v){
			$resultado = 3;
		}elseif($puntuacion_h < $puntuacion_v){
			$resultado = 4;
		}

		
		
		$juga = "UPDATE jugadas SET id_rjugada1= '$resultado' WHERE id_partidos1 = '$partido' AND id_rjugada1 = 1;";
		
		if ($cjuga = $conn->query($juga)){
			$buc ="SELECT id_usuarios1, puntos_a_ganar from jugadas
				WHERE  id_partidos1 = '$partido' AND jugada = id_rjugada1;";
			$cbuc =$conn->query($buc);
			while ($dbuc = $cbuc->fetch_array(MYSQLI_ASSOC)){
				$pun=$dbuc['puntos_a_ganar'];
				$usua=$dbuc['id_usuarios1'];
				$pup ="UPDATE puntos SET puntos_ganados=(puntos_ganados+'$pun') where id_usuarios2 = '$usua';";
				$cpup = mysqli_query($conn,$pup);

				if ($cpup){ header('Location: ../resultado.php');
				}
			
			}
			
		}else{echo'algo pao';}


		
	}else{echo'algo malo paso';}



 ?>