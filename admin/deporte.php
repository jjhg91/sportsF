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
	<title>Deporte</title>
	<link rel="stylesheet" type="text/css" href="adcss/adminheader.css">
	<link rel="stylesheet" type="text/css" href="adcss/deporte.css">
</head>
<body>

<?php include('adminheader.php') ?>

<section>







<div class="todo">
	<div class="depor">
		<p>Deporte </p>
	</div>
	

	<?php 
include('../php/conn.php');
$buc = "SELECT id_deportes,deportes,foto_d FROM deportes;";
$cb = mysqli_query($conn,$buc);


$a=2;
switch (TRUE) {
	
	case ($a===1):
	
		while ($coo = mysqli_fetch_array($cb)) {
 			$depo = $coo['deportes'];
		 	$imag = $coo['foto_d'];
 			$id_d = $coo['id_deportes'];

 			echo '
 				<a href="liga.php?deporte='.$id_d.'">
 					<div class="deporte">
						<img src="../imagenes/'.$imag.'">
						<span>'.$depo.'</span>
					</div>
				</a>'
			;
 		} 


		break;
	
	case ($a===2):
		echo'
		<div class="agregard" id="agregard">Agregar</div>
	<div class="agregar" id="agregar">
		
		<form class="deporte" 	action="adphp/deporte.php" method="POST" enctype="multipart/form-data">
			<div class="form">
				<label for="deporte">Agregar deporte</label>
				<input type="text" id="deporte" name="deporte"></input>
			</div>
			<div class="form">
				<label for="imagend">imagen</label>
				<input type="file" id="imagend" name="imagend"/>
			</div>
			<div class="form">
				<input type="submit" id="btn-submit" value="Agregar"></input>
			</div>
		</form>
	</div>';

	

		while ($coo = mysqli_fetch_array($cb)) {
 			$depo = $coo['deportes'];
		 	$imag = $coo['foto_d'];
 			$id_d = $coo['id_deportes'];
 			

 			echo '
 				<a href="liga.php?deporte='.$id_d.'">
 					<div class="deporte">
						<img src="../imagenes/'.$imag.'">
						<span>'.$depo.'</span>
					</div>
				</a><div class="agregard editar" id="editar">Editar</div>
				'
			;

			echo'
				<div class="agregar" id="agregar">
		
					<form class="deporte form-editar"  id="form-editar"	action="adphp/deporte.php" method="POST" enctype="multipart/form-data">
						<div class="form">
							<label for="deporte">Deporte: </label>
							<input type="text" id="deporte" name="deporte" value="'.$depo.'"/>
						</div>
						<div class="form">
							<label for="imagend">Imagen: </label>
							<input type="file" id="imagend" name="imagend" value="'.$imag.'"/>
						</div>
						<div class="form">
							<input type="submit" id="btn-submit" value="Editar"></input>
						</div>
					</form>
				</div>';
 		} 






		break;
}


 ?>
	
	
	


</div>






<script src="adjs/ocultar-deporte.js"></script>
</section>

</body>
</html>