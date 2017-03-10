
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


	$ref = $_SESSION['id_usuarios'];
	include ('php/conn.php');
 ?>

 <aside class="publicidad">
	<div class="invi">
		<p class="titulo">Invita a tus amigos</p>
		<p class="contenido">comparte el siguiente link con tus amigos y gana 2000 puntos por cada referido obtenido y el 25% por cada promocion que completen tus referidos</p>
		<form class="invi">
			<label class="invi" for="invitar">Tu link de invitacion</label>
			<input class="invi" type="text" id="invitar" name="invitar" value="localhost/proyecto/regitro.php?refer=<?php echo $ref;?>" readonly="readonly">
		</form>
	</div>




<?php 

	if (isset($_GET['partido'])) {

		echo'<div class="tooo">';
	
	
		$part = $_GET['partido'];

		if ($part != '') {
			$bj = "SELECT * FROM jugadas 
					inner join usuarios on usuarios.id_usuarios=jugadas.id_usuarios1
					inner join partidos on partidos.id_partidos=jugadas.id_partidos1
					WHERE id_partidos1 = '$part';";
			$cbj = mysqli_query($conn,$bj);
		
			while ($dbj = mysqli_fetch_array($cbj)){
				$nom = $dbj['usuario'];
				$pnt = $dbj['puntos_jugados'];
				$jug = $dbj['jugada'];
				$fot= $dbj['foto'];

				if ($jug == 2) {
				$equipo = 'Empante';
				}else{
					if($jug == 1){
			 			$jugada = $dbj['id_equiposh'];
					}if($jug == 2){
			 			$jugada = 'empate';
					}if ($jug == 3) {
			 			$jugada = $dbj['id_equiposv'];
					}
					$bjugada = "SELECT equipos FROM equipos WHERE id_equipos = '$jugada';";
					$cjugada = mysqli_query($conn,$bjugada);
					$djugada = mysqli_fetch_array($cjugada);
					$equipo = $djugada['equipos'];

				}
			


				echo '
					<div class="altj">
						<img src="imagenes/perfil/'.$fot.'">
						<div class="chul">
							<p class="nomb">'.$nom.'</p>
							<p class="jugada">'.$pnt.' puntos por '.$equipo.'</p>
						</div>

					</div>

				';

			}
		}

		echo'</div>';
	}



 ?>



	

<?php 
	if (isset($_GET['deporte'])) {
		echo'<div class="lig">';

		$dep = $_GET['deporte'];

		if ($dep != ''){
			$bu = "SELECT id_deportes,deportes FROM deportes WHERE deportes = '$dep';";
			$cbu = mysqli_query($conn,$bu);
			$qbu = mysqli_fetch_array($cbu);
			$depor = $qbu['id_deportes'];

			$dep = "SELECT id_ligas,ligas,id_deportes1 FROM ligas 
	 		WHERE id_deportes1 = '$depor';";	 	
	 		$de = mysqli_query($conn,$dep);

	 		while($nli = mysqli_fetch_array($de)){
	 			echo'
	 				<a class="lig" href="deporte.php?liga='.$nli['id_ligas'].'">
						<div class="liga">
							<span>'.$nli['ligas'].'</span>
						</div>
					</a>
	 			';
	 		}

	 	}else{echo "aqui";}

	 	echo '</div>';
	}


?>
	



	

	</aside>