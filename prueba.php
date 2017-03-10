<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
</head>
<body>
	<div class="contenedor-formulario">
		<div class="wrap">
			<form action="php/logear.php" class="formulario" name="formulario_registro" method="post">
				
				<select>
					<option>alfin</option>
					<option>lo</option>
					<option>hizo</option>
					<option>mmgv</option>
				</select>

				<input type="submit" id="btn-submit" value="Enviar">
				
				<?php 
					echo $_SERVER["HTTP_CLIENT_IP"];
					echo $_SERVER["REMOTE_ADDR"]; 

					?>
			</form>
		</div>
	</div>

</body>
</html>