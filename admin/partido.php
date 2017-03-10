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
	<link rel="stylesheet" type="text/css" href="adcss/partido.css">
</head>
<body>

<?php include('adminheader.php') ?>

<section>

<?php 
	include('../php/conn.php');
	$lig = $_GET['liga'];
	$hom = $_GET['equipo'];


	$buc = "SELECT id_deportes,deportes,id_ligas,ligas,id_equipos,equipos FROM equipos 
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE id_equipos = '$hom';";

	$cbuc = mysqli_query($conn,$buc);
	$dbuc = mysqli_fetch_array($cbuc);

	$otr = "SELECT id_equipos,equipos FROM equipos 
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE id_ligas = '$lig';";

	$cotr = mysqli_query($conn,$otr);




 ?>







<?php 
	$in=$conn->query("SELECT deportes,ligas,equipos FROM equipos 
					inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
					inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
					inner join deportes on deportes.id_deportes=ligas.id_deportes1
					WHERE id_equipos = '$hom' AND id_ligas = '$lig';");
	$inff=$in->fetch_array(MYSQLI_ASSOC);

 ?>


<div class="todo">
	<div class="depor">
		<p><?php echo  $inff['deportes'].' > '.$inff['ligas'].' > '.$inff['equipos']; ?></p>
	</div>


	<?php 
	$part = "SELECT id_partidos,id_equiposh,id_equiposv,fecha,deportes,uno,dos,tres FROM partidos 
			inner join equipos on equipos.id_equipos=partidos.id_equiposh
			inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
			inner join ligas on ligas.id_ligas=ligas_equipos.id_ligas1
			inner join deportes on deportes.id_deportes=ligas.id_deportes1
			WHERE id_ligas2 = '$lig' AND (id_equiposh = '$hom' OR id_equiposv = '$hom') AND actualizado = 1 ;";
	
	$cpart = mysqli_query($conn,$part);


	$a=2;
	switch (TRUE) {
		case ($a===1):
		
			while($dpart= mysqli_fetch_array($cpart)){
			    $bh= $dpart['id_equiposh'];
				$bush= "SELECT * from equipos WHERE id_equipos = '$bh';";
				$roh= mysqli_query($conn,$bush);
				$rah= mysqli_fetch_array($roh);
				$bv= $dpart['id_equiposv'];
				$busv= "SELECT * from equipos WHERE id_equipos = '$bv';";
				$rov= mysqli_query($conn,$busv);
				$rav= mysqli_fetch_array($rov);
				$home= $rah['equipos'];
				$visitante= $rav['equipos'];
				$date = date_create($dpart['fecha']);
				$fecha = date_format($date,'Y/m/d');
				$hora = date_format($date,"H:i");
				$link = $dpart['id_partidos'];
				$one = $dpart['uno'];
				$do = $dpart['dos'];
				$tre = $dpart['tres'];


				echo'
					<a href="resultado.php?partido='.$dpart['id_partidos'].'">
						<div class="liga">
							<span>Home: '.$home.'</span>
							<span>VS</span>
							<span>Visitante: '.$visitante.'</span>
							<span>Fecha: '.$fecha.' a las '.$hora.'</span>
							<span>H: '.$one.' E: '.$do.' V: '.$tre.'</span>
						</div>
					</a>
				';
			}





			break;
		
		case ($a===2):
			echo'

				<div class="agregarj" id="agregarj">Agregar</div>
				<div class="agregar" id="agregar">
					<form class="partido" action="adphp/partido.php" method="POST" name="prueba">
						<div class="grupo arrib nover">
							<input type="number" name="liga" id="liga" value="'.$dbuc['id_ligas'].'" readonly="readonly">
						</div>
						<div class="grupo ">
						
							<div class="nover">
								<input type="number" name="home" value="'.$dbuc['id_equipos'].'" readonly="readonly">
							</div>
						
							<label for="vit">Contra</label>
							<select name="vit" id="vit" class="vit">
								<option value="0"></option>
			';
								 while ( $dotr = mysqli_fetch_array($cotr)) {
									echo '<option value="'.$dotr['id_equipos'].'">'.$dotr['equipos'].'</option>';
								}

						echo'
							</select>
						</div>
						<div class="grupo ">
							<label for="dia">Dia</label>
							<input type="number" id="dia" name="dia" min="01" max="31"></input>
							<label for="mes">Mes</label>
							<input type="number" id="mes" name="mes" min="01" max="12"></input>
							<label for="año">Año</label>
							<input type="number" id="año" name="año" min="2017" max="2050"></input>
							<label for="hora">Hora</label>
							<input type="number" id="hora" name="hora" min="00" max="24"></input>
							<label for="min">Min</label>
							<input type="number" id="min" name="min" min="00" max="60"></input>

						</div>
						<div class="grupo">

							<label for="one" class="pu">Home</label>
							<input type="number" id="one" name="one"></input>
							<label for="do" class="pu">Empate</label>
							<input type="number" id="do" name="do"></input>
							<label for="tre" class="pu">Visitante</label>
							<input type="number" id="tre" name="tre"></input>
						</div>
						<div class="grupo">
							<input type="submit" id="btn-submit" value="Agregar"></input>
						</div>
					</form>
				</div>
			';


			while($dpart= mysqli_fetch_array($cpart)){
			    $bh= $dpart['id_equiposh'];
				$bush= "SELECT * from equipos WHERE id_equipos = '$bh';";
				$roh= mysqli_query($conn,$bush);
				$rah= mysqli_fetch_array($roh);
				$bv= $dpart['id_equiposv'];
				$busv= "SELECT * from equipos WHERE id_equipos = '$bv';";
				$rov= mysqli_query($conn,$busv);
				$rav= mysqli_fetch_array($rov);
				$home= $rah['equipos'];
				$visitante= $rav['equipos'];
				$date = date_create($dpart['fecha']);
				$fecha = date_format($date,'Y/m/d');
				$hora = date_format($date,"H:i");
				$link = $dpart['id_partidos'];
				$one = $dpart['uno'];
				$do = $dpart['dos'];
				$tre = $dpart['tres'];


				echo'
					<a href="resultado.php?partido='.$dpart['id_partidos'].'">
						<div class="liga">
							<span>Home: '.$home.'</span>
							<span>VS</span>
							<span>Visitante: '.$visitante.'</span>
							<span>Fecha: '.$fecha.' a las '.$hora.'</span>
							<span>H: '.$one.' E: '.$do.' V: '.$tre.'</span>
						</div>
					</a>
					<div class="agregarj editar">Editar</div>
				';
			

			echo'

				<div class="agregar">
					<form class="partido" action="adphp/partido.php" method="POST" name="prueba">
						<div class="grupo arrib nover">
							<input type="number" name="liga" id="liga" value="'.$dbuc['id_ligas'].'" readonly="readonly">
						</div>
						<div class="grupo ">
						
							<div class="nover">
								<input type="number" name="home" value="'.$dbuc['id_equipos'].'" readonly="readonly">
							</div>
						
							<label for="vit">Contra</label>
							<select name="vit" id="vit" class="vit">
								<option value="0"></option>
			';
								 while ( $dotr = mysqli_fetch_array($cotr)) {
								 	
								 
								 	
								 		echo '<option value="'.$dotr['id_equipos'].'">'.$dotr['equipos'].'</option>';
								 	}
									
								

						echo'
							</select>
						</div>
						<div class="grupo ">
							<label for="dia">Dia</label>
							<input type="number" id="dia" name="dia" min="01" max="31"></input>
							<label for="mes">Mes</label>
							<input type="number" id="mes" name="mes" min="01" max="12"></input>
							<label for="año">Año</label>
							<input type="number" id="año" name="año" min="2017" max="2050"></input>
							<label for="hora">Hora</label>
							<input type="number" id="hora" name="hora" min="00" max="24"></input>
							<label for="min">Min</label>
							<input type="number" id="min" name="min" min="00" max="60"></input>

						</div>
						<div class="grupo">

							<label for="one" class="pu">Home</label>
							<input type="number" id="one" name="one"></input>
							<label for="do" class="pu">Empate</label>
							<input type="number" id="do" name="do"></input>
							<label for="tre" class="pu">Visitante</label>
							<input type="number" id="tre" name="tre"></input>
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



</div>


















<script src="adjs/partido.js"></script>
</section>

</body>
</html>