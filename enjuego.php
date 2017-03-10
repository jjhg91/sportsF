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
	<link rel="stylesheet" type="text/css" href="css/enjuego.css">
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
				<li><a href="jugadas.php?user=<?php echo $user; ?>">JUGADAS</a></li>
				<li><a href="enjuego.php?user=<?php echo $user; ?>" class="act">EN JUEGO</a></li>
				<li><a href="promociones.php?user=<?php echo $user; ?>">PROMOCIONES</a></li>
				<li><a href="referidos.php?user=<?php echo $user; ?>">REFERIDOS</a></li>
				<li><a href="social.php?user=<?php echo $user; ?>">SOCIAL</a><li>
				<li><a href="regalos.php?user=<?php echo $user; ?>">REGALOS</a></li>
				<li><a href="recargas.php?user=<?php echo $user; ?>">RECARGAS</a></li>

		
			</ul>
		</div>
		<div class="crefe">
		<span class="ref">En juego</span>

		<?php 
			include("php/conn.php");
			$usua = $user;

			$enj = "SELECT * FROM jugadas
					inner join partidos on partidos.id_partidos=jugadas.id_partidos1
					WHERE id_usuarios1 = '$usua' AND  id_rjugada1 = '1';";

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
				$fecha = date_format($date,'Y-m-d');
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
		

				echo'<div class="enjuego">
			<span class=" icon-clock"></span>
			<p>Has jugado '.$punto.' puntos en el evento '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' <br/>el dia: '.$fecha.' hora: '.$hora.'</p>
		</div>';


			}





		 ?>
		</div>
	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>