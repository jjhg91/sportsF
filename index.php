<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scale=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/logear.css">
	<title>LOGEAR</title>
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/blogear.js"></script>
</head>
<body>


<div class="hola" id="hola">CLICK AQUI</div>

<div class="parpa">Bienvenido, ya falta poco.</div>
<a href="admin/" id="chao">Admin</a>

<div class="prueba" name="prueba">PRUEBA</div>
	<div class="contenedor-formulario">
		<div class="wrap">
			<form action="php/logear.php" class="formulario" name="formulario_registro" method="post">
				
					<div class="input-group">
						<input type="email" id="email" name="email">
						<label class="label" for="email">Correo</label>
					</div>
					
					<div class="input-group">
						<input type="password" id="pass" name="pass">
						<label class="label" for="pass">Contraseña</label>
					</div>
					<div>
						<input type="submit" id="btn-submit" value="Enviar">
						<p>si aun no tiene una cuenta <a href="regitro.php">Regitrate</a>. </p>
				</div>

			</form>
		</div>
	</div>
	<script src="java/logear.js"></script>
	<script src="java/ocultar_deporte.js"></script>
</body>
</html>