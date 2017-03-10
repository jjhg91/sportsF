<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scale=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/regitro.css">
	<title>Registro</title>
</head>
<body>
	<div class="contenedor-formulario">
		<div class="wrap">
			<form action="php/reg.php" class="formulario" name="formulario_registro" method="post">
				
					<div class="input-group">
						<input type="text" id="text" name="text">
						<label class="label" for="text">Usuario</label>
					</div>

					<div class="input-group">
						<input type="email" id="email" name="email">
						<label class="label" for="email">Correo</label>
					</div>

					<div class="input-group">
						<input type="email" id="email2" name="email2">
						<label class="label" for="email2">Repetir Correo</label>
					</div>
					
					<div class="input-group">
						<input type="password" id="pass" name="pass">
						<label class="label" for="pass">Contraseña</label>
					</div>
					
					<div class="input-group">
						<input type="password" id="pass2" name="pass2">
						<label class="label" for="pass2">Repetir Contraseña</label>
					</div>

					<?php 
					include('php/conn.php');

					 	$bpai = "SELECT * FROM pais;";
					 	$bzh = "SELECT * FROM zonahoraria;";
					 	$rp = mysqli_query($conn,$bpai);
					 	$rz = mysqli_query($conn,$bzh);
					 ?>

					<div class="input-group">
					<select id="pais" name="pais">
						<option>Seleccionar Pais</option>
						<?php while ($rop = mysqli_fetch_array($rp)) {
							echo '<option value="'.$rop['id_pais'].'">'.$rop['pais'].'</option>';
						} ?>
					</select>
					</div>
					
					<div class="input-group">
					<select id="zhoraria" name="zhoraria">
						
						<option>Seleccionar zona horaria</option>
						<?php while ($roz = mysqli_fetch_array($rz)) {
							$ciudad = $roz['ciudad'];
							$hora = $roz['zonahoraria']/* ->format("h:i")*/;
							echo '<option value="'.$roz['id_zhoraria'].'">'.$hora.' '.$ciudad.'</option>';
						}?>
					</select>
					</div>

					<div class="input-group radio error">
						<input type="radio" name="sexo" id="hombre" value="2">
						<label for="hombre">Hombre</label>
						<input type="radio" name="sexo" id="mujer" value="3">
						<label for="mujer">Mujer</label>
					</div>
					<div class="input-group checkbox error">
						<input type="checkbox" name="terminos" id="terminos" value="true">
						<label for="terminos">Acepto los terminos y condiciones</label>
					</div>

					<?php  
					
					
						
					
						if (isset($_GET['refer'])) {
						
						$referido = $_GET['refer'];
						
					if ($referido != '' && ctype_digit($referido)) {
						echo '
						<div class="novisto">
							<input type="text" name="referido" value="'.$referido.'" readonly="readonly">
						</div>';
					}}

					?>
					


						<input type="submit" id="btn-submit" value="Enviar"> 
				

			</form>
		</div>
	</div>

	<script src="java/regitro.js"></script>
</body>
</html>