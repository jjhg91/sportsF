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
	<link rel="stylesheet" type="text/css" href="css/regaloss.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php  include("plantilla/publi.php");?>
	<section class="cont">
		<div class="categoria">

			<ul>
				<li class="act">Regalos</li>

		
			</ul>
		</div>
		

		<div class="perfil">
			<div class="opt">
				<span class="per">Puedes conseguir estos fabulosos regalos</span>
			</div>
			
			<div class="susss">


				<?php 

					$breg=$conn->query("SELECT * FROM regalos;");

					while ($reg=$breg->fetch_array(MYSQLI_ASSOC)) {
						
						$id_reg=$reg['id_regalos'];
						$rega=$reg['regalo'];
						$pn_reg=$reg['p_necesarios'];
						$f_reg=$reg['foto_regalo'];

						echo'
							<div class="unid">
								<img src="imagenes/regalos/'.$f_reg.'" class="f_reg">
								<div class="inn">
								<p class="inn">'.$rega.'</p>
								<p class="pts">'.$pn_reg.'</p>
								<a href="descripcion_regalo.php?id_regalo='.$id_reg.'">Descripcion</a>
								</div>
							</div>
						';




					}







				 ?>
			

			
			</div>
			

		
		</div>



	


		

		

	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>