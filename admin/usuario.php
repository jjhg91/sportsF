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

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="adcss/adminheader.css">
	<link rel="stylesheet" type="text/css" href="adcss/usuario.css">
</head>
<body>

	<?php include('adminheader.php') ?>


	<section>

		<div class="todo">
	
			<div class="depor"><p>Usuarios</p></div>

			<div class="buscar">
				
				<form class="usuario" action="adphp/buscar_usuario.php" method="POST">
					<div class="grupo">
						<label for="buscar_u">Buscar</label>
						<input type="text" id="buscar_u" name="buscar_u">
					</div>
					<div class="grupo">
						<input type="submit" id="btn-submit" value="Buscar">
					</div>
				</form>

		
			
		</div>

		<?php 

			include("../php/conn.php");

			if (isset($_GET['usr'])) {
				$usr=$_GET['usr']; 
			}else{ $usr= null;}

			if (isset($_GET['id'])) {
				$id=$_GET['id']; 
			}else{ $id= null;}

		?>
		

		<div class="categoria">
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=perfil">Perfil</a>
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=conexiones">Conexiones</a>
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=puntos">Puntos</a>
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=jugadas">jugadas</a>
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=social">Social</a>
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=promociones">Promociones</a>
			<a href="usuario.php?usr=<?php echo $usr; ?>&id=regalos">Regalos</a>

		</div>


		




		<div class="bote"> 


			<?php 

				switch (TRUE) {
					case ($id==='perfil') and ($usr!=null):
						
						$inf_=$conn->query("SELECT usuario,correo,foto,banner,pais,zonahoraria,ciudad,c_postal,nombre,
								apellido,natalidad,nivel_usuario,stusuario,genero,puntos_acumulados FROM usuarios 
								inner join nombre on nombre.id_nombre=usuarios.id_nombre1
								inner join apellido on apellido.id_apellido=usuarios.id_apellido1
								inner join genero on genero.id_genero=usuarios.id_genero1
								inner join Natalidad on natalidad.id_natalidad=usuarios.id_natalidad1
								inner join zonahoraria on zonahoraria.id_zhoraria=usuarios.id_zhoraria1
								inner join pais on pais.id_pais=usuarios.id_pais1
								inner join postal on postal.id_postal=usuarios.id_postal1
								inner join statusuario on statusuario.id_stusuario=usuarios.id_stusuario1
								inner join nivel_usuario on nivel_usuario.id_nusuario=usuarios.id_nusuario1
								inner join puntos on puntos.id_usuarios2=usuarios.id_usuarios
								WHERE id_usuarios = $usr;");

						$inf_u=$inf_->fetch_array(MYSQLI_ASSOC);


						echo'
							<p> Puntos: <span> '.$inf_u['puntos_acumulados'].'</span></p>
							<p> Status: <span> '.$inf_u['stusuario'].'</span></p>
							<p> Nivel Usuario: <span> '.$inf_u['nivel_usuario'].'</span></p>
							<p> Usuario: <span> '.$inf_u['usuario'].'</span></p>
							<p> Correo: <span> '.$inf_u['correo'].'</span></p>
							<p> Genero: <span> '.$inf_u['genero'].'</span></p>
							<p> Nombre: <span> '.$inf_u['nombre'].'</span></p>
							<p> Apellido: <span> '.$inf_u['apellido'].'</span></p>
							<p> Natalidad: <span> '.$inf_u['natalidad'].'</span></p>
							<p> Zona horaria: <span> '.$inf_u['zonahoraria'].'  '.$inf_u['ciudad'].'</span></p>
							<p> Pais: <span> '.$inf_u['pais'].'</span></p>
							<p> Codigo postal: <span> '.$inf_u['c_postal'].'</span></p>
							<p> Direccion: <span> </span></p>
							<p> Banner: <span> '.$inf_u['banner'].'</span></p>
							<p> Foto: <span> '.$inf_u['foto'].'</span></p>

						';




						break;

						case ($id==='puntos') and ($usr!=null):





						$qpt=$conn->query("SELECT * FROM puntos WHERE id_usuarios2 = $usr;");
							$apt=$qpt->fetch_array(MYSQLI_ASSOC);

							echo'
								<p>Total: <span>'.$apt['puntos_acumulados'].'</span></p>
								<p>Puntos ganados: <span>'.$apt['puntos_ganados'].'</span></p>
								<p>Perdidos: <span>'.$apt['puntos_perdidos'] .'</span></p>
								<p>En juego: <span>'.$apt['punstos_enjuego'].'</span></p>
								<p>Bonus diario: <span>'.$apt['puntos_bonus_diario'].'</span></p>
								<p>Promociones: <span>'.$apt['puntos_promociones'].'</span></p>
								<p>Referidos: <span>'.$apt['puntos_referidos'].'</span></p>
								<p>Sub-referidos: <span>'.$apt['puntos_subreferidos'].' </span></p>
								<p>Regalos: <span>'.$apt['puntos_regalos'].'</span></p>

							';


						break;



























						case ($id==='jugadas') and ($usr!=null):


							$enj = "SELECT * FROM jugadas
							inner join partidos on partidos.id_partidos=jugadas.id_partidos1
							WHERE id_usuarios1 = '$usr' AND  id_rjugada1 != 1;";

							$cenj = mysqli_query($conn,$enj);
			

							while ($denj = mysqli_fetch_array($cenj)){
								$rt = $denj['jugada'];
								$tr = $denj['id_rjugada1'];
								$h = $denj['id_equiposh'];
								$v = $denj['id_equiposv'];
								$eqh = "SELECT equipos FROM equipos WHERE id_equipos = '$h';";
								$eqv = "SELECT equipos FROM equipos WHERE id_equipos = '$v';";
								$ceqh = mysqli_query($conn,$eqh);
								$ceqv = mysqli_query($conn,$eqv);
								$deqh = mysqli_fetch_array($ceqh);
								$deqv = mysqli_fetch_array($ceqv);
								$home = $deqh['equipos'];
								$empate = "Empate";
								$visitante = $deqv['equipos'];
								$one = $denj['uno'];
								$do = $denj['dos'];
								$tre = $denj['tres'];
						
								$date = date_create($denj['fecha']);
								$fecha = date_format($date,'d-m-Y');
								$hora = date_format($date,"H:i");


								$punto = $denj['puntos_jugados'];
								$ju = $denj['jugada'];
								if($ju == 2 ){
									$jugada = $home;
									$cuota = $one;
								}if ($ju == 3 ) {
									$jugada = $empate;
									$cuota = $do;
								}if ($ju == 4) {
									$jugada = $visitante;
									$cuota = $tre;
								}


								if ($rt == $tr) {
									echo '<div class="gano">
										<span class="icon-checkmark"></span>
										<p>Has ganado '.$punto.' puntos en el partido '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' fecha: '.$fecha.'</p>
									</div>';
								}
								if ($rt != $tr) {
									echo'<div class="perdio">
										<span class="icon-cross"></span>
										<p>Has perdido '.$punto.' puntos en el partido '.$home.' vs '.$visitante.' apostando a '.$jugada.' a cuota '.$cuota.' fecha: '.$fecha.'</p>
										</div>';
								}


							}
						break;
					

				}




			 ?>

			
			








	
			


		</div>







</section>

</body>
</html>