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
	<link rel="stylesheet" type="text/css" href="css/deporte.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/aside.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/publi.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php include("plantilla/publi.php"); ?>
	<section class="cont">
	<div class="part">
	





	<?php  
	include('php/conn.php');
	

if (isset($_GET['deporte'])) {

	$deporte = $_GET['deporte'];
	
if ($deporte != '') {	
	$busc = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE deportes = '$deporte' AND actualizado = 1 ;";
	$roo = mysqli_query($conn,$busc);
	$rooo = mysqli_query($conn,$busc);

	$rou= mysqli_fetch_array($roo);
	$deport = $rou['deportes'];

	echo '<span class="deport">'.$deport.'</span>';

		while($roa= mysqli_fetch_array($rooo)) {
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
				

			$nn=time();
			$ho=$nn+(60);
			$hoy=date('d-m-Y H:i',$ho);
			
			$ddn= New datetime($hoy);
			$fechn= New datetime($roa['fecha']);
			$interval= $ddn->diff($fechn);
			



		
			
			
			if ($interval->format('%a') == 0 ) {
				$fecha = 'Hoy: '.$hora;
			}elseif($interval->format('%a') == 1){
				$fecha='Mañana: '.$hora;
				
			}
			else{$fecha = date_format($date,'d-m-Y  ').' /  Hora: '.$hora;;}


			
			$link = $roa['id_partidos'];

			echo 
			'<div class="tabla">
			<img src="imagenes/bat.png" class="deporte">
			<div class="info">
			<p class="deport">'.$home.'</p>
			<p class="deport vs">VS</p>
			<p class="deport">'.$visitante.'</p>
			<div class="inf"><time class="fecha">'.$fecha.'</time><a href="#" class="liga">LIGAAAAAAAA</a></div>
			<div class="boton"><a href="partido.php?partido='.$link.'"><span>Jugar</span></a></div>
			</div>
			</div>';

		}
}}


if (isset($_GET['liga'])) {

$lig = $_GET['liga'];
if ($lig != '') {
	
	
	$lb= "SELECT id_partidos,id_equiposh,id_equiposv,fecha,ligas FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE id_ligas = '$lig';";
	$clb = mysqli_query($conn,$lb);
	$cclb = mysqli_query($conn,$lb);

	$dlb= mysqli_fetch_array($clb);
	$liga = $dlb['ligas'];

echo '<span class="deport">'.$liga.'</span>';

		while($ddlb= mysqli_fetch_array($cclb)) {
		    $lbh= $ddlb['id_equiposh'];
			$lush= "SELECT * from equipos WHERE id_equipos = '$lbh';";
			$loh= mysqli_query($conn,$lush);
			$lah= mysqli_fetch_array($loh);
			$lbv= $ddlb['id_equiposv'];
			$lusv= "SELECT * from equipos WHERE id_equipos = '$lbv';";
			$lov= mysqli_query($conn,$lusv);
			$lav= mysqli_fetch_array($lov);
			$home= $lah['equipos'];
			$visitante= $lav['equipos'];
			$date = date_create($ddlb['fecha']);
			$fecha = date_format($date,'Y/m/d');
			$hora = date_format($date,"H:i");
			$link = $ddlb['id_partidos'];

			echo 
			'<div class="tabla">
			<img src="imagenes/bat.png" class="deporte">
			<div class="info">
			<p class="deport">'.$home.'</p>
			<p class="deport vs">VS</p>
			<p class="deport">'.$visitante.'</p>
			<div class="inf"><time class="fecha">'.$fecha.'</time><a href="#" class="liga">LIGAAAAAAAA</a></div>
			<div class="boton"><a href="partido.php?partido='.$link.'"><span>Jugar</span></a></div>
			</div>
			</div>';

	}
	}
}





	
	?>
	</div>
	</section>
	<?php include("plantilla/aside.php"); ?>
	<?php include("plantilla/footer.php"); ?>
</div>

<span class="deport"></span>

</body>
</html>