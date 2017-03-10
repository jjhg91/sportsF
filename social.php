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
				<li><a href="enjuego.php?user=<?php echo $user; ?>">EN JUEGO</a></li>
				<li><a href="promociones.php?user=<?php echo $user; ?>">PROMOCIONES</a></li>
				<li><a href="referidos.php?user=<?php echo $user; ?>">REFERIDOS</a></li>
				<li><a href="social.php?user=<?php echo $user; ?>" class="act">SOCIAL</a><li>
				<li><a href="regalos.php?user=<?php echo $user; ?>">REGALOS</a></li>
				<li><a href="recargas.php?user=<?php echo $user; ?>">RECARGAS</a></li>

		
			</ul>
		</div>
		
	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>