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
	<link rel="stylesheet" type="text/css" href="css/inicio.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">
<?php include("php/conn.php") ?>
	<?php include("plantilla/publi.php"); ?>
	<section class="cont">
	
		<!-- FAVORITOS -->


		
	





	<?php  
	include('php/conn.php');
	
echo'<div class="part">';
	

	$busc = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes, COUNT(id_partidos) AS mas_jugado FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			left join jugadas on jugadas.id_partidos1=partidos.id_partidos
			
			GROUP BY id_partidos 
			ORDER BY fecha ASC 
			LIMIT 5;";
	$roo = mysqli_query($conn,$busc);
	$rooo = mysqli_query($conn,$busc);

	$rou= mysqli_fetch_array($roo);
	$deport = $rou['deportes'];

	echo '<span class="deport">Deporte Favorito</span>';

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
			



		
			
			
			if ($interval->format('%R%a') === 0 ) {
				$fecha = 'Hoy: '.$hora;
			}elseif($interval->format('%R%a') === 1){
				$fecha='Mañana: '.$hora;
				
			}
			else{$fecha = date_format($date,'d-m-Y  ').' /  Hora: '.$hora;}


			
			$link = $roa['id_partidos'];

			
			$masjugado=$roa['mas_jugado'];

			echo 
			'<div class="tabla">
			<img src="imagenes/bat.png" class="deporte">
			<div class="info">
			<p class="deport">'.$home.'</p>
			<p class="deport vs">VS</p>
			<p class="deport">'.$visitante.'</p>
			<div class="inf"><time class="fecha">'.$fecha.'</time><a href="#" class="liga">LIGAAAAAAAA</a><p>'.$masjugado.'</p></div>
			<div class="boton"><a href="partido.php?partido='.$link.'"><span>Jugar</span></a></div>
			</div>
			</div>';

		}



echo '</div>';

	
	?>
	





		<!-- MAS JUGADOS-->

		<div class="part">
	





	<?php  
	include('php/conn.php');
	


	

	$busc = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes, COUNT(id_partidos) AS mas_jugado FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			inner join jugadas on jugadas.id_partidos1=partidos.id_partidos
			WHERE actualizado = 1
			GROUP BY id_partidos 
			ORDER BY mas_jugado DESC 
			LIMIT 5;";
	$roo = mysqli_query($conn,$busc);
	$rooo = mysqli_query($conn,$busc);

	$rou= mysqli_fetch_array($roo);
	$deport = $rou['deportes'];

	echo '<span class="deport">Mas jugados</span>';

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
			



		
			
			
			if ($interval->format('%a') === 0 ) {
				$fecha = 'Hoy: '.$hora;
			}elseif($interval->format('%a') === 1){
				$fecha='Mañana: '.$hora;
				
			}
			else{$fecha = date_format($date,'d-m-Y  ').' /  Hora: '.$hora;}


			
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





	
	?>
	</div>




	<br>

	

	</section>
	<?php include("plantilla/aside.php"); ?>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>

