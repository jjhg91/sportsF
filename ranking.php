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
	<link rel="stylesheet" type="text/css" href="css/ranking.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php include("plantilla/publi.php"); ?>
	<section class="cont">
	<div class="categoria">

			<ul>
				
				<li><a href="jugadas.php" class="act">Ranking</a></li>
		
			</ul>
		</div>

		<div class="crefe">
			<div class="opt">
				<span class="gan"><a href="ranking.php">Top puntos</a></span>
				<span class="gan"><a href="ranking.php?id=topjugadas">Top jugada</a></span>
				<span class="gan"><a href="ranking.php?id=topaciertos">Top aciertos</a></span>
			</div>

			<?php 

			if (isset($_GET['id'])) {
				$id= $_GET['id'];
			}else{$id = 'toppuntos';}
			

			



			if ($id === "toppuntos") {
				$enj = "SELECT usuario,foto,banner,puntos_acumulados FROM USUARIOS 
				inner join puntos on puntos.id_usuarios2=usuarios.id_usuarios order by puntos_acumulados desc limit 100;";

				$cenj = mysqli_query($conn,$enj);
			

				while ($denj = mysqli_fetch_array($cenj)){
					$rt = $denj['usuario'];
					$tr = $denj['foto'];
					$h = $denj['banner'];
					$v = $denj['puntos_acumulados'];
					
					
					echo '<div class="gano">
							<style type="text/css">
							section.cont div.gano {
							background-image: url("imagenes/banner/'.$h.'");
							background-size: 100% 100%;
							 }
							</style>
							<img src="imagenes/perfil/'.$tr.'" class="foot">
							<span><p>'.$rt.'</p> <p>Puntos: '.$v.'</p></span>
						</div>';				
			


			}}else{

				if ($id === "topjugadas") {
					$enj = "SELECT usuario,foto,banner,puntos_jugados,id_partidos1,jugada,id_equiposh,id_equiposv,fecha FROM USUARIOS 
				inner join jugadas on jugadas.id_usuarios1=usuarios.id_usuarios
				inner join partidos on partidos.id_partidos=jugadas.id_partidos1 order by puntos_jugados desc limit 100;";

					$cenj = mysqli_query($conn,$enj);
			

					while ($denj = mysqli_fetch_array($cenj)){
						$rt = $denj['usuario'];
						$tr = $denj['foto'];
						$h = $denj['banner'];
						$v = $denj['puntos_jugados'];
						$eh = $denj['id_equiposh'];
						$ev = $denj['id_equiposv'];
						$eqh = "SELECT equipos FROM equipos WHERE id_equipos = '$eh';";
						$eqv = "SELECT equipos FROM equipos WHERE id_equipos = '$ev';";
						$ceqh = mysqli_query($conn,$eqh);
						$ceqv = mysqli_query($conn,$eqv);
						$deqh = mysqli_fetch_array($ceqh);
						$deqv = mysqli_fetch_array($ceqv);
						$home = $deqh['equipos'];
						$empate = "Empate";
						$visitante = $deqv['equipos'];
						$date = date_create($denj['fecha']);
						$fecha = date_format($date,'Y-m-d');
						$ju = $denj['jugada'];
						if($ju == 1 ){
							$jugada = $home;
							
						}if ($ju == 2 ) {
							$jugada = $empate;
							
						}if ($ju == 3) {
							$jugada = $visitante;
							
						}

						

						echo '<div class="gano">
							<style type="text/css">
							section.cont div.gano {
							background-image: url("imagenes/banner/'.$h.'");
							background-size: 100% 100%;
							 }
							</style>
							<img src="imagenes/perfil/'.$tr.'" class="foot">
							<span><p>'.$rt.'</p> <p class="topjugadas">'.$home.' vs '.$visitante.'partdo '.$fecha.' Ha jugado al: '.$jugada.' '.$v.'</p></span>
						</div>';




				
					}
				}
				if ($id === "topaciertos") {
					$enj = "SELECT * FROM jugadas
					inner join partidos on partidos.id_partidos=jugadas.id_partidos1
					WHERE id_usuarios1 = '$usua' AND  id_rjugada1 != 3;";

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
						$fecha = $denj['fecha']->format("d-m-y");
						$punto = $denj['puntos_jugados'];
						$ju = $denj['jugada'];
						if($ju == 1 ){
							$jugada = $home;
							$cuota = $one;
						}if ($ju == 2 ) {
							$jugada = $empate;
							$cuota = $do;
						}if ($ju == 3) {
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
	<?php include("plantilla/aside.php"); ?>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>