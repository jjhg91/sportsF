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
	<link rel="stylesheet" type="text/css" href="css/ediperfil.css">
	<link rel="stylesheet" type="text/css" href="iconos/icomoon/style.css">
	<script src="java/jquery-2.2.3.min.js"></script>
	<script src="java/inicio.js"></script>
	<script src="highcharts/code/highcharts.js"></script>
	<script src="highcharts/code/modules/exporting.js"></script>
</head>

<body>
<?php $user=$_GET['user']; ?>

<script type="text/javascript">

/////////////GRAFICA EN CIRCULO//////////////////////////


$(function () {
    Highcharts.chart('container1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jugadas'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [
            	<?php  
            	include("php/conn.php");
            		$sult=$conn->query("SELECT id_deportes,deportes FROM deportes;");
            		$tot=$conn->query("SELECT id_jugadas FROM jugadas WHERE id_usuarios1='$user';");

					

					while ($resul=$sult->fetch_array(MYSQLI_ASSOC) AND $total=$tot->num_rows) {
						
						$dep=$conn->query("SELECT id_jugadas FROM jugadas 
											inner join partidos on partidos.id_partidos=jugadas.id_partidos1
											inner join  ligas on ligas.id_ligas=partidos.id_ligas2
											WHERE id_deportes1='".$resul['id_deportes']."' AND id_usuarios1='$user';");


						$ndep=$dep->num_rows;
						$cantidad=$ndep*100/$total;
						echo "{ name: '".$resul['deportes']."', y: ".$cantidad.", }, ";
						
					}
            	?>	  
             ]
        }]
    });
});





//////////////////GRAFICA LINEAL///////////////////
$(function () {
    Highcharts.chart('container2', {
        title: {
            text: 'Balance de la semana',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes',
                'Sabado']
        },
        yAxis: {
            title: {
                text: 'Puntos'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'Pts'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Puntos',
            data: [4000, 6000, 4000, 5000, 7000, 4000, 12000]
        }, 
            ]
    });
});
		</script>





<?php  include("plantilla/header.php");?>

<div class="padre">

	<?php  include("plantilla/publi.php");?>
	<section class="cont">

		
	
		<div class="categoria">

			<ul>
				<li><a href="perfil.php?user=<?php echo $user; ?>" class="act">PERFIL</a></li>
				<li><a href="jugadas.php?user=<?php echo $user; ?>">JUGADAS</a></li>
				<li><a href="enjuego.php?user=<?php echo $user; ?>">EN JUEGO</a></li>
				<li><a href="promociones.php?user=<?php echo $user; ?>">PROMOCIONES</a></li>
				<li><a href="referidos.php?user=<?php echo $user; ?>">REFERIDOS</a></li>
				<li><a href="social.php?user=<?php echo $user; ?>">SOCIAL</a><li>
				<li><a href="regalos.php?user=<?php echo $user; ?>">REGALOS</a></li>
				<li><a href="recargas.php?user=<?php echo $user; ?>">RECARGAS</a></li>

		
			</ul>
		</div>
		

		<div class="perfil">
			<div class="opt">
				<span class="per"><a href="perfil.php?user=<?php echo $user; ?>">Perfil</a></span>
				<?php if ($user===$_SESSION['id_usuarios']) {
					echo'<span class="per"><a href="perfil.php?user='.$user.'&id=editarperfil">Editar perfil</a></span>';
					echo'<span class="per"><a href="perfil.php?user='.$user.'&id=informacionpersonal">Informacion personal</a></span>';
				} ?>
				
			</div>
			
			<?php 

				if (isset($_GET['id'])) {
					$url = $_GET['id'];
				}else{$url = 'perfil';}


				
				if ($url === 'perfil') {

					$enj = "SELECT id_usuarios,usuario,foto,banner,puntos_acumulados FROM USUARIOS 
							inner join puntos on puntos.id_usuarios2=usuarios.id_usuarios WHERE id_usuarios='$user';";

					$cenj = mysqli_query($conn,$enj);
			

					$denj = mysqli_fetch_array($cenj);
						$rt = $denj['usuario'];
						$tr = $denj['foto'];
						$h = $denj['banner'];
						$v = $denj['puntos_acumulados'];
						/*$j = $denj['puntos_enjuego'];*/
					
					
						echo '<div class="gano">
							<style type="text/css">
							section.cont div.gano {
							background-image: url("imagenes/banner/'.$h.'");
							background-size: 100% 100%;
							 }
							</style>
							<img src="imagenes/perfil/'.$tr.'" class="foot">
							<div><p class="use">'.$rt.'</p> <p class="inff"><span>Puntos: '.$v.'</span><span>En juego: 0000</span></p></div>
							</div>';
					




					////////////////INFORMACION GRAFICA/////////////

					echo '<div class="infgrafica">
							<span class="pts"><p>Puntos: '.$v.'</p><p>En juego: 1000</p><p class="total">Total: 6000</p></span>

							<span class="juegos">';


					$sul=$conn->query("SELECT id_deportes,deportes FROM deportes;");
            		$to=$conn->query("SELECT id_jugadas FROM jugadas WHERE id_usuarios1='$user';");
            		$tota=$tot->num_rows;
					

					while ($resu=$sul->fetch_array(MYSQLI_ASSOC) ) {
						
						$de=$conn->query("SELECT id_jugadas FROM jugadas 
											inner join partidos on partidos.id_partidos=jugadas.id_partidos1
											inner join  ligas on ligas.id_ligas=partidos.id_ligas2
											WHERE id_deportes1='".$resu['id_deportes']."' AND id_usuarios1='$user';");


						$nde=$de->num_rows;
						
						echo "<p>".$resu['deportes'].": ".$nde."</p>";
					}




					echo '<p class="total">Total: '.$tota.'</p></span>';

                      /////////////////////  GRAFICA ///////////////
					echo '<div class="graficas"><div class="graficas1">';
					ECHO'<div id="container2" style="min-width: 310px; height: 300px; margin: 0 auto"></div>';
					echo '</div><div class="graficas2">';
					ECHO'<div id="container1" class="grafica" style="min-width: 310px; height: 300px; max-width: 600px; margin: 0 auto"></div>';
					echo '</div></div>';
					
		
	 
					
					}



				if ($url === 'editarperfil' AND $user===$_SESSION['id_usuarios']) {

					$bd = "SELECT * from deportes;";
					$cbd = $conn->query($bd);

					$zh = "SELECT * from zonahoraria;";
					$czh = mysqli_query($conn,$zh);
					
					$qdf=$conn->query("SELECT id_deportes2 FROM deporte_favorito WHERE id_usuarios4=$user;");
					$adf=$qdf->fetch_array(MYSQLI_ASSOC);
					$df=$adf['id_deportes2'];
					echo '
					<form class="imagen" action="php/subir.php" method="POST" enctype="multipart/form-data">
	 					<div class="grup">
	 						<label for="imagen">Imagen:</label>
	 						<input type="file" name="imagen" id="imagen" />
	 					</div>
	 					<div class="grup">
	 						<label for="banner">Banner:</label>
	 						<input type="file" name="banner" id="banner" />
	 					</div>
	 					<div class="grup">
	 						<label for="deportef">Deporte Favorito: </label>
	 						<select id="deportef" name="deportef">
	 						<option value="">Seleccionar Deporte Favorito</option>';
	 					
	 					while ($db = $cbd->fetch_array(MYSQLI_ASSOC)) {
	 						if ($df===$db['id_deportes']){
	 							echo'<option value="'.$db['id_deportes'].'" selected="selected">'.$db['deportes'].'</option>';
	 						}else{
	 						echo'<option value="'.$db['id_deportes'].'">'.$db['deportes'].'</option>';}
	 					}
	 					echo'
					
	 						</select>
	 					</div>
	 					<div class="grup">
	 					<label for="zhoraria">Zona horaria: </label>
	 					<select id="zhoraria" name="zhoraria">
	 						<option>Seleccionar Zona Horaria</option>';
	 					while ($dzh = $czh->fetch_array(MYSQLI_ASSOC)) {
	 						echo'<option value="'.$dzh['id_zhoraria'].'">'.$dzh['zonahoraria'].' '.$dzh["ciudad"].'</option>';
	 					}

	 					echo '
	 					</select>
	 					</div>
	 					<div class="grup">
	 					<input type="submit" name="subir" value="Actulizar"/>
	 					</div>
		 			</form>';









					
				}elseif ($url === 'editarperfil' AND $user!==$_SESSION['id_usuarios']) {
					header("location: perfil.php?user='.$user.'");
				}








				if ($url === 'informacionpersonal' AND $user===$_SESSION['id_usuarios']) {

					$bus = "SELECT * FROM usuarios WHERE id_usuarios = '$_SESSION[id_usuarios]';";
					$pre = $conn->query($bus);
					$roo = $pre->fetch_array(MYSQLI_ASSOC);

					$pais = "SELECT * FROM pais;";
					$cpais = mysqli_query($conn,$pais);

					$ge = "SELECT * FROM genero;";
					$cge = mysqli_query($conn,$ge);


					if ($roo['id_edperfil1']=== '1') {
						
					
					echo '<form class="datos" action="php/infpersonal.php" method="POST">
						<div class="grup">
							<label for="nombre">Nombre</label>	
							<input type="text" id="nombre" name="nombre" value="Juan" />
						</div>
						<div class="grup">
							<label for="apellido">Apellido</label>
							<input type="text" id="apellido" name="apellido" value="Herrera" />
						</div>
						<div class="grup">	
							<label for="pais">Pais</label>
							<select id="pais" name="pais">
								<option>Elije Tu Pais</option>';
								while ($dpais = mysqli_fetch_array($cpais)) {
									echo'<option value="'.$dpais['id_pais'].'">'.$dpais['pais'].'</option>';
								}

					echo '
						</select>	
						</div>
						<div class="grup">	
							<label for="genero">Genero</label>
							<select id="genero" name="genero">
								<option>Elije Tu Genero</option>';
								while ($dge = mysqli_fetch_array($cge)) {
									echo '<option value="'.$dge['id_genero'].'">'.$dge['genero'].'</option>';
								}
								
					echo '
						</select>
				
						</div>
						<div class="grup">
							<label for="fna">fecha de nacimiento</label>
							<input type="text" id="fna" id="fna"></input>
						</div>
						<div class="grup">
							<label for="cpo">codigo postal</label>
							<input type="text" id="cpo" name="cpo"></input>
						</div>
						<div class="grup">
							<label for="dir">direccion</label>
							<input type="text" id="dir"	name="dir"></input>
						</div>
						<input type="submit" name="subir" value="Actulizar"/>
						</form>';
					}

					if($roo['id_edperfil1']=== 2){
						echo '<form class="datos" action="" method="POST">
						<div class="grup">
							<label for="nombre">Nombre</label>	
							<input type="text" id="nombre" name="nombre" value="Juan" readonly="readonly/>
						</div>
						<div class="grup">
							<label for="apellido">Apellido</label>
							<input type="text" id="apellido" name="apellido" value="Herrera" readonly="readonly/>
						</div>
						<div class="grup">	
							<label for="pais">Pais</label>
							<select id="pais" name="pais">
								<option>Elije Tu Pais</option>';
								while ($dpais = mysqli_fetch_array($cpais)) {
									echo'<option value="'.$dpais['id_pais'].'">'.$dpais['pais'].'</option>';
								}

					echo '
						</select>	
						</div>
						<div class="grup">	
							<label for="genero">Genero</label>
							<select id="genero" name="genero">
								<option>Elije Tu Genero</option>';
								while ($dge = mysqli_fetch_array($cge)) {
									echo '<option value="'.$dge['id_genero'].'">'.$dge['genero'].'</option>';
								}
								
					echo '
						</select>
				
						</div>
						<div class="grup">
							<label for="fna">fecha de nacimiento</label>
							<input type="text" id="fna" id="fna" readonly="readonly></input>
						</div>
						<div class="grup">
							<label for="cpo">codigo postal</label>
							<input type="text" id="cpo" name="cpo" readonly="readonly></input>
						</div>
						<div class="grup">
							<label for="dir">direccion</label>
							<input type="text" id="dir"	name="dir" readonly="readonly></input>
						</div>
						<input type="submit" name="subir" value="Actulizar"/>
						</form>';

					}
				}






			?>



			

		
		</div>



	



		

	</section>
	<?php include("plantilla/footer.php"); ?>
</div>



</body>
</html>


