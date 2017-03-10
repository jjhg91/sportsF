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
	<link rel="stylesheet" type="text/css" href="css/suscripcion.css">
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
				<li class="act">Suscripcion VIP</li>

		
			</ul>
		</div>
		

		<div class="perfil">
			<div class="opt">
				<span class="per">Como usuario VIP obtienes fantasticas ventajas.</span>
			</div>
			
			<div class="suss">

			<div class="info">
			
				<div class="onn"><span class="icon-plus"></span><p>todas tus jugadas tienen bonificaciones, gana mas con cada jugada realizada.</p></div>
				<div class="onn"><span class="icon-gift"></span> <p>cajas misteriosas para que las abras cuando quieras</p></div>
				<div class="onn"><span class="icon-users"></span><p>invita a tus amigos y recibe mas puntos que los usuarios normales</p></div>	
			

			
				<div class="onn"><span class="icon-coin-dollar"></span><p>recibe premios especiales</p></div>
				<div class="onn"><span class="icon-copy"></span><p>sistema de copiado de jugadas</p></div>
				<div class="onn"><span class="icon-newspaper"></span><p>sin anuncios publicitarios</p></div>	
			

			
				<div class="onn"><span class="icon-trophy"></span><p>todo tipo de sorteos mensuales</p></div>
				<div class="onn"><span class="icon-meter"></span><p>gana mas en las promociones que realices</p></div>
				<div class="onn"><span class="icon-clock"></span><p>recibe tus regalos mas rapidos</p></div>
		
			</div>

			<div class="oferta">
				<div class="tar">
					<h2 class="bronze">Bronze</h2>
					<div class="list">
						<ul>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 10% mas con tus jugadas</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 10% mas con tus referidos</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 30% mas en las promociones</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">6 y 3 cajas misteriosas</span></li>

							<li><span class="icono icon-cross"></span><span class="list">aqui los que no trae</span></li>
							
						</ul>
					</div>
				</div>

				<div class="tar">
					<h2 class="plata">Plata</h2>
					<div class="list">
						<ul>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 20% mas con tus jugadas</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 20% mas con tus referidos</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 30% mas con las promociones</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Recibe tus regalos mas rapido</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">12 y 6 cajas misteriosas</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Copiar apuestas</span></li>
						</ul>
					</div>
				</div>

				<div class="tar">
					<h2 class="oro">Oro</h2>
					<div class="list">
						<ul>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 30% mas con tus jugadas</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana 30% mas con tus referidos</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Gana el doble en las promociones</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Premios en metalicos</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Sorteos mensuales</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Recibe tus regalos mas rapidos</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">20 y 10 cajas misteriosas</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Sin publicidad</span></li>
							<li><span class="icono icon-checkmark"></span><span class="list">Copiar apuestas</span></li>
						</ul>
					</div>
				</div>

			</div>
			</div>
			

		
		</div>



	


		

		

	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>