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
	<link rel="stylesheet" type="text/css" href="adcss/liga.css">
</head>
<body>

<?php include('adminheader.php') ?>




<section>

	<div class="todo">
		

	<?php 
		include('../php/conn.php');
		$lo=$_GET['deporte'];

		$bu = "SELECT id_deportes,deportes FROM deportes WHERE id_deportes = '$lo';";
		$cbu = mysqli_query($conn,$bu);
		$qbu = mysqli_fetch_array($cbu);

	 	$dep = "SELECT id_ligas,ligas,id_deportes1 FROM ligas 
	 	WHERE id_deportes1 = '$lo';";	 	
	 	$de = mysqli_query($conn,$dep);

$a=2;

		echo'
			<div class="deporte">
				<p>'.$qbu['deportes'].'</p>
			</div>

		';


	 	switch (TRUE) {
	 		case ($a===1):
	 			
	 			while($nli = mysqli_fetch_array($de)){
					echo'
						<a href="equipo.php?liga='.$nli['id_ligas'].'">
							<div class="liga">
								<span>'.$nli['ligas'].'</span>
							</div>
						</a>
					';
				}





	 			break;
	 		
	 		case ($a===2):
	 			echo'
	 				<div class="agregarl" id="agregarl">Agregar</div>
	 				<div class="agregar" id="agregar">
						<form class="liga" action="adphp/liga.php" method="POST">
							<div class="grupo">
								<label for="liga">Agregar liga</label>
								<input type="text" id="liga" name="liga"></input>
							</div>
							<div class="grupo nover">
								<input type="text" name="deport" id="deport" value="'.$qbu['id_deportes'].'" readonly="readonly">
							</div>
							<div class="grupo">
								<input type="submit" id="btn-submit" value="Agregar"></input>
								</div>
						</form>
					</div>
				';
	 			
	 			while($nli = mysqli_fetch_array($de)){
					echo'
						<a href="equipo.php?liga='.$nli['id_ligas'].'">
							<div class="liga">
								<span>'.$nli['ligas'].'</span>
							</div>
						</a>
						<div class="agregarl editar" id="editar">Editar</div>
					';

					echo'
	 					<div class="agregar" id="agregar">
							<form class="liga" action="adphp/liga.php" method="POST">
								<div class="grupo">
									<label for="liga">Liga: </label>
									<input type="text" id="liga" name="liga" value="'.$nli['ligas'].'"></input>
								</div>
								<div class="grupo nover">
									<input type="text" name="deport" id="deport" value="'.$qbu['id_deportes'].'" readonly="readonly">
								</div>
								<div class="grupo">
									<input type="submit" id="btn-submit" value="Agregar"></input>
								</div>
							</form>
						</div>
					';
				}


	 			break;
	 	}
	 	

	 ?>

	<script src="adjs/ocultar-liga.js"></script>




</div>


</section>

</body>
</html>