<?php	
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	}else{
		echo"Esta pagina es para registrados";
		exit;
	}
	//$now = time();
	//if ($now > $_SESSION['expire']) {
	//	session_destroy();
	//	echo "su sesion a terminado";
	//	exit();
	//}
 ?>
<header>
	
<?php 
	include('php/conn.php');
	$usu = $_SESSION['id_usuarios'];
	$enj = "SELECT SUM(puntos_jugados)as enjue FROM jugadas WHERE id_usuarios1 = '$usu' AND id_rjugada1  = 1;";
	$cenj = mysqli_query($conn,$enj);
	
	$denj = mysqli_fetch_array($cenj);
	$enjue = $denj['enjue'];
	

 ?>
	<div class="icon-menu"></div>

	<nav>
	<div class="perfil">
		<img src="imagenes/perfil/<?php include("php/usua.php"); echo $roo['foto']; ?>">
		<div class="nombre">  <?php include("php/usua.php"); echo $roo['usuario']; ?></div>
		<ul>
			<li class="in"><a href=""><?php echo $roo['puntos_acumulados']; ?><span>pts</span></a></li>
			<li class="in enju"><a href=""><?php if (isset($enjue)){echo $enjue;}else{ echo'0';} ?> <br><span>en juego</span></a></li>
			<li class="in"><a href="ranking.php" class="b1">Ranking</a></li>
			<li class="in"><a href="suscripcion.php" class="b2">Suscribete VIP</a></li>
			<li class="in"><a href="recarga.php" class="b3">Recarga</a></li>
		</ul>
	</div>
	<div class="categoria">
	<p id="pulsa">DEPORTES</p>
		<ul class="prueba2" id="prueba2">
			<?php 
				
				
				$bucar= "SELECT id_deportes,deportes,foto_d FROM deportes;";
				$roo= mysqli_query($conn,$bucar);
				$i=0;
				
				WHILE ($rob=mysqli_fetch_array($roo)){
					$i++;
					echo 
						'<li>
						<a href="deporte.php?deporte='.$rob['deportes'].'" class="a'.$i.'">
						<img src="imagenes/'.$rob['foto_d'].'">
						<span>'.$rob['deportes'].'</span>
						</a>
						</li>';

					
				}
			 ?>
		</ul>
	<p>POTE</p>
	<p>QUINELAS</p>

		<script src="java/ocultar_deporte.js"></script>
	</div>

	
</nav>
		
	<ul class="menu2">	
		
		<li><a href="regaloss.php" title="Regalos"><span class="icon-gift"></span></a></li>
		<li><a href="perfil.php?user=<?php echo $_SESSION['id_usuarios'];?>" title="Perfil"><span class="icon-user"></span></a></li>
		<li><a href="php/salir.php" title="Salir"><span class="icon-switch"></span></a></li>
	</ul>
	<a href="#" class="punto_g"><span class="punto_g">Puntos gratis</span></a>
</header>
