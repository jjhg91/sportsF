<?php 
	include("../../php/conn.php");

	$li = $_GET['liga'];
	$lig = $_POST['lig'];
	$equi = $_POST['equipo'];


	$bu = "SELECT equipos, id_ligas1 FROM equipos inner join ligas_equipos on ligas_equipos.id_equipos1=equipos.id_equipos WHERE equipos = '$equi' and id_ligas1 = '$lig';";
	$cbu = mysqli_query($conn,$bu);
	$nbu = mysqli_num_rows($cbu);

	if ($nbu > 0) {
		echo 'el equipo ya ah sido registrado';
	}else{
		
		$bi = "SELECT id_equipos,equipos FROM equipos WHERE equipos = '$equi';";
		$cbi = mysqli_query($conn,$bi);
		$ccbi = mysqli_query($conn,$bi);
		$nbi = mysqli_num_rows($cbi);
		$abi = mysqli_fetch_array($conn,$ccbi);
		
		if($nbi > 0){

				$lin = "INSERT INTO ligas_equipos(id_ligas1,id_equipos1) VALUES('".$lig."','".$abi['id_equipos']."');";
				$clin = mysqli_query($conn,$lin);
				header('Location: ../equipo.php?liga='.$lig.'');
			
		}else{
			$in = "INSERT INTO equipos(equipos) VALUES('".$equi."');";
			$cin = mysqli_query($conn,$in);

			$inb = "SELECT id_equipos FROM equipos WHERE equipos = '$equi';";
			
			$cinb = mysqli_query($conn,$inb);
			$ninb = mysqli_num_rows($cinb);
			

			$ccinb = mysqli_query($conn,$inb);
			$qinb = mysqli_fetch_array($ccinb);
			$eq = $qinb['id_equipos'];
			
			
			if ($ninb > 0){
				$iin = "INSERT INTO ligas_equipos(id_ligas1,id_equipos1) VALUES('".$lig."','".$eq."');";
				$ciin = mysqli_query($conn,$iin);
				header('Location: ../equipo.php?liga='.$lig.'');

			}else{ echo 'no se pudo registar el equipo, ni la liga';}
			
		}
		
	}






 ?>