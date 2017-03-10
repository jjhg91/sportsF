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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Start Bets</title>
	<link rel="stylesheet" type="text/css" href="css/section.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/aside.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/publi.css">
	<link rel="stylesheet" type="text/css" href="css/perfil.css">
	<link rel="stylesheet" type="text/css" href="css/jugadas.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php  include("plantilla/publi.php");?>
	<section class="cont">
	<?php $user=$_GET['user']; ?>
		<div class="categoria">

			<ul>
				<li><a href="perfil.php?user=<?php echo $user; ?>">PERFIL</a></li>
				<li><a href="jugadas.php?user=<?php echo $user; ?>" class="act">JUGADAS</a></li>
				<li><a href="enjuego.php?user=<?php echo $user; ?>">EN JUEGO</a></li>
				<li><a href="promociones.php?user=<?php echo $user; ?>">PROMOCIONES</a></li>
				<li><a href="referidos.php?user=<?php echo $user; ?>">REFERIDOS</a></li>
				<li><a href="social.php?user=<?php echo $user; ?>">SOCIAL</a><li>
				<li><a href="regalos.php?user=<?php echo $user; ?>">REGALOS</a></li>
				<li><a href="recargas.php?user=<?php echo $user; ?>">RECARGAS</a></li>

		
			</ul>
		</div>

		<div class="crefe">
			<div class="opt">
				<span class="gan"><a href="jugadas.php?user=<?php echo $user; ?>">Todas</a></span>
				<span class="gan"><a href="jugadas.php?user=<?php echo $user; ?>&id=ganadas">Ganadas</a></span>
				<span class="gan"><a href="jugadas.php?user=<?php echo $user; ?>&id=perdidas">Perdidos</a></span>
			</div>

			<?php 

			if (isset($_GET['id'])) {
				$id = $_GET['id'];
							
			}else{$id = 'todas';}
			
			$usua = $user;

			



			if ($id === "todas") {
				$enj = "SELECT * FROM jugadas
					inner join partidos on partidos.id_partidos=jugadas.id_partidos1
					WHERE id_usuarios1 = '$usua' AND  id_rjugada1 != 1;";

				$cenj = mysqli_query($conn,$enj);
			

				while ($denj = mysqli_fetch_array($cenj)){
					$rt = $denj['jugada'];
					$tr = $denj['id_rjugada1'];
					$h = $denj['id_equiposh'];
					$v = $denj['id_equiposv'];
					$eqh = "SELECT equipos FROM equipos WHERE id_equipos = '$h';";
					$eqv = "SELECT equipos FROM equipos WHERE id_equipos = '$v';";
					$ceqh = mysqli_query($conn,$eqh);
					$ceqv = mysqli_query($conn,$eqv);
					$deqh = mysqli_fetch_array($ceqh);
					$deqv = mysqli_fetch_array($ceqv);
					$home = $deqh['equipos'];
					$empate = "Empate";
					$visitante = $deqv['equipos'];
					$one = $denj['uno'];
					$do = $denj['dos'];
					$tre = $denj['tres'];
					
					$date = date_create($denj['fecha']);
					$fecha = date_format($date,'d-m-Y');
					$hora = date_format($date,"H:i");


					$punto = $denj['puntos_jugados'];
					$ju = $denj['jugada'];
					if($ju == 2 ){
						$jugada = $home;
						$cuota = $one;
					}if ($ju == 3 ) {
						$jugada = $empate;
						$cuota = $do;
					}if ($ju == 4) {
						$jugada = $visitante;
						$cuota = $tre;
					}

				if ($rt == $tr) {
					echo '<div class="gano">
							<span class="icon-checkmark"></span>
							<p>Has ganado '.$punto.' puntos en el partido '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' fecha: '.$fecha.'</p>
						</div>';
				}
				if ($rt != $tr) {
					echo'<div class="perdio">
							<span class="icon-cross"></span>
							<p>Has perdido '.$punto.' puntos en el partido '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' fecha: '.$fecha.'</p>
						</div>';
				}
			


			}}else{

				if ($id === "ganadas") {
					$enj = "SELECT * FROM jugadas
					inner join partidos on partidos.id_partidos=jugadas.id_partidos1
					WHERE id_usuarios1 = '$usua' AND  id_rjugada1 = jugada;";

					$cenj = mysqli_query($conn,$enj);
			

					while ($denj = mysqli_fetch_array($cenj)){
						$h = $denj['id_equiposh'];
						$v = $denj['id_equiposv'];
						$eqh = "SELECT equipos FROM equipos WHERE id_equipos = '$h';";
						$eqv = "SELECT equipos FROM equipos WHERE id_equipos = '$v';";
						$ceqh = mysqli_query($conn,$eqh);
						$ceqv = mysqli_query($conn,$eqv);
						$deqh = mysqli_fetch_array($ceqh);
						$deqv = mysqli_fetch_array($ceqv);
						$home = $deqh['equipos'];
						$empate = "Empate";
						$visitante = $deqv['equipos'];
						$one = $denj['uno'];
						$do = $denj['dos'];
						$tre = $denj['tres'];

						$date = date_create($denj['fecha']);
						$fecha = date_format($date,'d-m-Y');
						$hora = date_format($date,"H:i");

						$punto = $denj['puntos_jugados'];
						$ju = $denj['jugada'];
						if($ju == 2 ){
							$jugada = $home;
							$cuota = $one;
						}if ($ju == 3 ) {
							$jugada = $empate;
							$cuota = $do;
						}if ($ju == 4) {
							$jugada = $visitante;
							$cuota = $tre;
						}

						echo '<div class="gano">
								<span class="icon-checkmark"></span>
								<p>Has ganado '.$punto.' puntos en el partido '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' fecha: '.$fecha.'</p>
							</div>';




				
					}
				}
				if ($id === "perdidas") {
					$enj = "SELECT * FROM jugadas
					inner join partidos on partidos.id_partidos=jugadas.id_partidos1
					WHERE id_usuarios1 = '$usua' AND  (id_rjugada1 != jugada AND  id_rjugada1  != 1 );";

					$cenj = mysqli_query($conn,$enj);
			

					while ($denj = mysqli_fetch_array($cenj)){
						$h = $denj['id_equiposh'];
						$v = $denj['id_equiposv'];
						$eqh = "SELECT equipos FROM equipos WHERE id_equipos = '$h';";
						$eqv = "SELECT equipos FROM equipos WHERE id_equipos = '$v';";
						$ceqh = mysqli_query($conn,$eqh);
						$ceqv = mysqli_query($conn,$eqv);
						$deqh = mysqli_fetch_array($ceqh);
						$deqv = mysqli_fetch_array($ceqv);
						$home = $deqh['equipos'];
						$empate = "Empate";
						$visitante = $deqv['equipos'];
						$one = $denj['uno'];
						$do = $denj['dos'];
						$tre = $denj['tres'];

						$date = date_create($denj['fecha']);
						$fecha = date_format($date,'d-m-Y');
						$hora = date_format($date,"H:i");
						$punto = $denj['puntos_jugados'];
						$ju = $denj['jugada'];
						if($ju == 2 ){
							$jugada = $home;
							$cuota = $one;
						}if ($ju == 3 ) {
							$jugada = $empate;
							$cuota = $do;
						}if ($ju == 4) {
							$jugada = $visitante;
							$cuota = $tre;
						}


						echo'<div class="perdio">
							<span class="icon-cross"></span>
							<p>Has perdido '.$punto.' puntos en el partido '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' fecha: '.$fecha.'</p>
						</div>';

					}
				}
			}
			

			/*<div class="perdio">
				<span class="icon-cross"></span>
				<p>Has perdido 1000 puntos en el partido leones vs magallanes apostando a magallanes a 	cuota 1.5</p>
			</div>
	
			<div class="gano">
				<span class="icon-checkmark"></span>
				<p>Has ganado 1500 puntos en el partido leones vs magallanes apostando a leones a cuota 1.5	</p>
			</div>*/
			?>
			
		</div>
	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>