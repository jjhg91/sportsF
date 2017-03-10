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

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="adcss/adminheader.css">
	<link rel="stylesheet" type="text/css" href="adcss/resultado.css">
</head>
<body>

<?php include('adminheader.php') ?>

<section>

<div class="todo">
	





	<?php 
	include('../php/conn.php');
	
	if (isset($_GET['resultado'])) {
		$url=$_GET['resultado'];
	}else{$url='actualizar';}


	switch ($url) {
		case $url=== 'actualizar':
			
			echo '<div class="depor"><p>Aregar resultado</p></div>
				<div class="algo"><a href="resultado.php?resultado=editar">Editar resultado</a></div>';



			$part = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes,uno,dos,tres FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE actualizado = 1;";
	
			$cpart = $conn->query($part);


			while($dpart= $cpart->fetch_array(MYSQLI_ASSOC)){
		   		$bh= $dpart['id_equiposh'];
				$bush= "SELECT * from equipos WHERE id_equipos = '$bh';";
				$roh= mysqli_query($conn,$bush);
				$rah= mysqli_fetch_array($roh);
				$bv= $dpart['id_equiposv'];
				$busv= "SELECT * from equipos WHERE id_equipos = '$bv';";
				$rov= mysqli_query($conn,$busv);
				$rav= mysqli_fetch_array($rov);
				$home= $rah['equipos'];
				$visitante= $rav['equipos'];
				$date = date_create($dpart['fecha']);
				$fecha = date_format($date,'d-m-Y');
				$hora = date_format($date,"H:i");
				$link = $dpart['id_partidos'];
				$one = $dpart['uno'];
				$do = $dpart['dos'];
				$tre = $dpart['tres'];

				echo'
				<div class="liga">
					
					<form class="resultado" action="adphp/act_resultado.php" method="POST">
				
						<input type="text" class="partido" id="partido" name="partido" value="'.$link.'" readonly="readonly">
				
						<label for="resultado_h"> '.$home.': </label>
						<input type="number" name="resultado_h" >

						<label for="resultado_v"> '.$visitante.': </label>
						<input type="number" name="resultado_v" >

						<input type="submit" id="btn-submit" value="Agregar">

					</form>

					<div class="inf">
						<span>Fecha: '.$fecha.' a las '.$hora.'</span>
						<span>H: '.$one.' E: '.$do.' V: '.$tre.'</span>
					</div>

				</div>
				';
			}







			break;
		
		case $url==='editar':
			
			echo '<div class="depor"><p>Editar resultado</p></div>
				<div class="algo"><a href="resultado.php">Agregar resultado</a></div>';

			$part = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes,uno,dos,tres,puntuacion_h,puntuacion_v FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE actualizado = 2;";
	
			$cpart = $conn->query($part);


			while($dpart= $cpart->fetch_array(MYSQLI_ASSOC)){
		   		$bh= $dpart['id_equiposh'];
				$bush= "SELECT * from equipos WHERE id_equipos = '$bh';";
				$roh= mysqli_query($conn,$bush);
				$rah= mysqli_fetch_array($roh);
				$bv= $dpart['id_equiposv'];
				$busv= "SELECT * from equipos WHERE id_equipos = '$bv';";
				$rov= mysqli_query($conn,$busv);
				$rav= mysqli_fetch_array($rov);
				$home= $rah['equipos'];
				$visitante= $rav['equipos'];
				$date = date_create($dpart['fecha']);
				$fecha = date_format($date,'d-m-Y');
				$hora = date_format($date,"H:i");
				$link = $dpart['id_partidos'];
				$one = $dpart['uno'];
				$do = $dpart['dos'];
				$tre = $dpart['tres'];
				$puntuacion_h = $dpart['puntuacion_h'];
				$puntuacion_v = $dpart['puntuacion_v'];
				echo'
				<div class="liga">
					
					<form class="resultado" action="adphp/edit_resultado.php" method="POST">
				
						<input type="text" class="partido" id="partido" name="partido" value="'.$link.'" readonly="readonly">
				
						<label for="resultado_h"> '.$home.': </label>
						<input type="number" name="resultado_h"  min="00" value="'.$puntuacion_h.'">

						<label for="resultado_v"> '.$visitante.': </label>
						<input type="number" name="resultado_v"  min="00" value="'.$puntuacion_v.'">

						<input type="submit" id="btn-submit" value="Agregar">

					</form>

					<div class="inf">
						<span>Fecha: '.$fecha.' a las '.$hora.'</span>
						<span>H: '.$one.'  E: '.$do.'  V: '.$tre.'</span>
					</div>

				</div>
				';
			}











			break;
	}
	



	?>
		
			
</div>







</section>

</body>
</html>