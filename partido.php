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
	<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Start Bets</title>
	<link rel="stylesheet" type="text/css" href="css/section.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/aside.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/publi.css">
	<link rel="stylesheet" type="text/css" href="css/partido.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php include("plantilla/publi.php"); ?>
	<section class="cont">
	<?php  
		include("php/conn.php") ;
 		$partido = $_GET['partido'];
 		$name = $_SESSION['id_usuarios'];

 		$bname = "SELECT puntos_acumulados FROM puntos WHERE id_usuarios2 = '$name';";
 		$cname = mysqli_query($conn,$bname);
 		$dname = mysqli_fetch_array($cname);
 		$pt = $dname['puntos_acumulados'];


	$busc = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes,ligas,uno,dos,tres FROM partidos 
		inner join equipos on equipos.id_equipos=partidos.id_equiposh
		inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
		inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
		inner join deportes on deportes.id_deportes=ligas.id_deportes1
		WHERE id_partidos = '$partido';";
	$roo = mysqli_query($conn,$busc);

		while($roa= mysqli_fetch_array($roo)) {
		    $deport= $roa['deportes'];
		    $lig= $roa['ligas'];
		    $bh= $roa['id_equiposh'];
			$bush= "SELECT * from equipos WHERE id_equipos = '$bh';";
			$roh= mysqli_query($conn,$bush);
			$rah= mysqli_fetch_array($roh);
			$bv= $roa['id_equiposv'];
			$busv= "SELECT * from equipos WHERE id_equipos = '$bv';";
			$rov= mysqli_query($conn,$busv);
			$rav= mysqli_fetch_array($rov);
			$home= $rah['equipos'];
			$visitante= $rav['equipos'];
			$date = date_create($roa['fecha']);
			
			$hora = date_format($date,"H:i");
			$link = $roa['id_partidos'];
			$h= $roa['uno'];
			$e= $roa['dos'];
			$v= $roa['tres'];
			$p = $roa['id_partidos'];

			
			$nn=time();
			$ho=$nn+(60);
			$hoy=date('d-m-Y H:i',$ho);
			
			$ddn= New datetime($hoy);
			$fechn= New datetime($roa['fecha']);
			$interval= $ddn->diff($fechn);
			



		
			
			
			if ($interval->format('%a') == 0 ) {
				$fecha = 'Hoy - Hora: '.$hora;
			}elseif($interval->format('%a') == 1){
				$fecha='Mañana: '.$hora;
				
			}
			else{$fecha = date_format($date,'d-m-Y  ').'/ Hora: '.$hora;}




	}
	?>
	
	<form class="for_partido" name="partidos"  action="php/jugada.php" method="POST">
		<div class="equipo">
			<span><?php echo $home ?></span>
			<input type="radio" name="jugada" id="home" value="2">
			<label for="home"><?php echo $h ?></label>
		</div>
		<div class="equipo em">
			<span class="em"><p class="em">empate</p></span>
			<input type="radio" name="jugada" id="em" value="3">
			<label for="em"><?php echo $e ?></label>
		</div>
		<div class="equipo">
			<span><?php echo $visitante ?></span>
			<input type="radio" name="jugada" id="vi" value="4">
			<label for="vi"><?php echo $v ?></label>
		</div>
		<div class="inf">
			<span class="fech"><?php echo $fecha ?></span>
			<p><?php echo $deport ?></p>
			<p><?php echo $lig ?></p>
		</div>

		<input type="text" class="part" id="part" name="part" value="<?php echo $p; ?>" readonly="readonly">

			<input type="range" min="1" max="<?php echo $pt; ?>" id="range" value="1"  name="range" />
			<input type="text" id="punto" name="punto" value="1">
			<input type="submit" value="Enviar">
	</form>

<script src="java/range.js"></script>
	</section>
	<?php include("plantilla/aside.php"); ?>
	<?php include("plantilla/footer.php"); ?>
</div>


</body>
</html>