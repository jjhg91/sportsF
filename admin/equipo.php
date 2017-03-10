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
	<link rel="stylesheet" type="text/css" href="adcss/equipo.css">
</head>
<body>

<?php include('adminheader.php') ?>

<section>
	<div class="todo">

<?php 
include('../php/conn.php');
	$lig = $_GET['liga'];

	$dl =  "SELECT id_ligas,ligas,id_deportes1,deportes FROM ligas
	inner join deportes on deportes.id_deportes=ligas.id_deportes1
	WHERE id_ligas = '$lig';";
	$cdl = mysqli_query($conn,$dl);
	$qdl = mysqli_fetch_array($cdl);

	$bu = "SELECT id_ligas,ligas,id_deportes1,deportes,id_equipos,equipos FROM ligas
	inner join deportes on deportes.id_deportes=ligas.id_deportes1
	inner join ligas_equipos on ligas_equipos.id_ligas1=ligas.id_ligas
	inner join equipos on equipos.id_equipos=ligas_equipos.id_equipos1
	WHERE id_ligas = '$lig';";
	$cbu = mysqli_query($conn,$bu);
	$qbu = mysqli_fetch_array($cbu);

	$hcbu = mysqli_query($conn,$bu);

$a=2;

	echo'
		<div class="deporte">
			<p>'. $qdl['deportes'].' > '.$qdl['ligas'].'</p>
		</div>
	';




	switch (TRUE) {
		case ($a===1):
			
			while($nli = mysqli_fetch_array($hcbu)){
				echo'
					<a href="partido.php?liga='.$nli["id_ligas"].'&equipo='.$nli["id_equipos"].'">
						<div class="liga">
							<span>'.$nli["equipos"].'</span>
						</div>
					</a>
				';
			}




			break;
		
		case ($a===2):
			
			echo'
				<div class="agregare" id="agregare">Agregar</div>
				<div class="agregar" id="agregar">
					<form class="equipo" action="adphp/equipo.php" method="POST">

						<div class="grupo">
							<label for="equipo">Agregar equipo</label>
							<input type="text" id="equipo" name="equipo"></input>
						</div>

						<div class="grupo nover">
							<input type="text" name="lig" id="lig" value="'.$qdl['id_ligas'].'" readonly="readonly">
						</div>

						<div class="grupo">
							<input type="submit" id="btn-submit" value="Agregar"></input>
						</div>
					</form>
				</div>
			';


			while($nli = mysqli_fetch_array($hcbu)){
				echo'
					<a href="partido.php?liga='.$nli["id_ligas"].'&equipo='.$nli["id_equipos"].'">
						<div class="liga">
							<span>'.$nli["equipos"].'</span>
						</div>
					</a>
					<div class="agregare editar" id="editar">Editar</div>
				';


				echo'
					
					<div class="agregar" id="agregar">
					<form class="equipo" action="adphp/equipo.php" method="POST">

						<div class="grupo">
							<label for="equipo">Equipo: </label>
							<input type="text" id="equipo" name="equipo"></input>
						</div>

						<div class="grupo nover">
							<input type="text" name="lig" id="lig" value="'.$qdl['id_ligas'].'" readonly="readonly">
						</div>

						<div class="grupo">
							<input type="submit" id="btn-submit" value="Editar"></input>
						</div>
					</form>
				</div>

				';
			}





			break;
	}

 ?>

<script src="adjs/ocultar-equipo.js"></script>




</div>
</section>

</body>
</html>