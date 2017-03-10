<?php 
	include("../../php/conn.php");

	$liga = $_POST['liga'];
	$home = $_POST['home'];
	$vit = $_POST['vit'];
	$fecha = $_POST['año'].'-'.$_POST['mes'].'-'.$_POST['dia'].' '.$_POST['hora'].':'.$_POST['min'];
	$one = $_POST['one'];
	$do = $_POST['do'];
	$tre = $_POST['tre'];




	$bu = "SELECT id_equipos,id_ligas1 FROM equipos 
		inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos
		WHERE id_ligas1 = '$liga' AND (id_equipos = '$home' OR id_equipos = '$vit');";
	$cbu = mysqli_query($conn,$bu);
	$nbu = mysqli_num_rows($cbu);

	if ($nbu == 2) {
		$in = "INSERT INTO partidos(id_ligas2,id_equiposh,id_equiposv,fecha,uno,dos,tres) VALUES('".$liga."','".$home."','".$vit."','".$fecha."','".$one."','".$do."','".$tre."');";
		$cin = mysqli_query($conn,$in) or die (print_r(sqlsrv_errors(), true));
		if($cin){
			header('Location: ../partido.php?liga='.$liga.'&equipo='.$home.'');

		}else{echo "no inserto partido";}


	}else {echo "equipos en diferente ligas";}




 ?>