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
	<link rel="stylesheet" type="text/css" href="css/referidos.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
</head>

<body>
<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php  include("plantilla/publi.php");?>
	<section class="cont">
		<?php 
			
			if (isset($_GET['user'])) {
				
				$user=$_GET['user'];
			}else{$url=$_SESSION['id_usuarios'];}

		?>
		<div class="categoria">

			<ul>
				<li><a href="perfil.php?user=<?php echo $user; ?>">PERFIL</a></li>
				<li><a href="jugadas.php?user=<?php echo $user; ?>">JUGADAS</a></li>
				<li><a href="enjuego.php?user=<?php echo $user; ?>">EN JUEGO</a></li>
				<li><a href="promociones.php?user=<?php echo $user; ?>">PROMOCIONES</a></li>
				<li><a href="referidos.php?user=<?php echo $user; ?>" class="act">REFERIDOS</a></li>
				<li><a href="social.php?user=<?php echo $user; ?>">SOCIAL</a><li>
				<li><a href="regalos.php?user=<?php echo $user; ?>">REGALOS</a></li>
				<li><a href="recargas.php?user=<?php echo $user; ?>">RECARGAS</a></li>


			</ul>
		</div>

		<div class="crefe">
		<div class="cate">
			<span class="ref"><a href="referidos.php?user=<?php echo $user; ?>">Referidos</a></span>
			<span class="ref"><a href="referidos.php?user=<?php echo $user; ?>&ref=subreferidos">Sub referidos</a></span>
		</div>


		<?php

			include("php/conn.php");
			

			if (isset($_GET['ref'])) {
				$url=$_GET['ref'];
			}else{$url='referidos';}
			


			switch (TRUE) {
				case ($url==="referidos"):
					
					$qref=$conn->query("SELECT usuario FROM referidos 
								inner join usuarios on usuarios.id_usuarios=referidos.id_usuarios3
								where id_referidos = $user;"); 

					WHILE($aref=$qref->fetch_array(MYSQLI_ASSOC)){

						echo'
							<div class="referido">
								<span class="icon-user-plus"></span>
								<p>Felicidades tienes un nuevo Referido: <span class="referido">'.$aref['usuario'].' </span></p>
							</div>
						';
					}






				break;
				
				case ($url==='subreferidos'):
					
					$qsref=$conn->query("SELECT usuario FROM subreferidos 
					inner join usuarios on usuarios.id_usuarios=subreferidos.id_usuarios9
					where id_subreferidos = $user;"); 

					WHILE($asref=$qsref->fetch_array(MYSQLI_ASSOC)){

						echo'
							<div class="referido">
								<span class="icon-user-plus"></span>
								<p>Felicidades tienes un nuevo Sub-referido: <span class="referido">'.$asref['usuario'].' </span></p>
							</div>
						';
					}


				break;
					
			}
			


		 ?>

		</div>

	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>
