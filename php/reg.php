<?php 
include("conn.php"); 
$cor = $_POST['email'];
$cont = $_POST['pass'];
$usu = $_POST['text'];
$pai = $_POST['pais'];
$zho = $_POST['zhoraria'];
$gen = $_POST['sexo'];



$bucar = "SELECT correo FROM usuarios WHERE correo ='$cor';";
$rb = mysqli_query($conn,$bucar) or die(print_r(sqlsrv_errors(), true));
$rob = mysqli_fetch_array($rb);
if ($rob[0] == $cor){
	echo 'Ya se encuentra registrado: '.$cor;

}else{
	$tsql = "INSERT INTO usuarios (usuario,correo,contra,id_pais1,id_zhoraria1,id_genero1) 
	VALUES ('".$usu."','".$cor."','".$cont."','".$pai."','".$zho."','".$gen."');";
	$InsertReview = mysqli_query($conn,$tsql); 
		if($InsertReview){
		$buc = "SELECT id_usuarios FROM usuarios WHERE correo ='$cor';";
		$cbuc = mysqli_query($conn,$buc);
		$dbuc = mysqli_fetch_array($cbuc);
		$ibuc = "INSERT INTO puntos(id_usuarios2) VALUES('".$dbuc['id_usuarios']."');";


		if (isset($_POST['referido'])) {
			$referido = $_POST['referido'];

			if (ctype_digit($referido)) {
				$dref = mysqli_fetch_array($cbuc);
				$iref = "INSERT INTO referidos(id_usuarios3,id_referidos) VALUES('".$dbuc['id_usuarios']."','".$referido."');"	;
				$cref = mysqli_query($conn,$iref);

				$bsref = "SELECT id_usuarios3 FROM referidos WHERE id_usuarios3 ='".$referido."';";
				$csref = mysqli_query($conn,$bsref);
				$nsref = mysqli_num_rows($csref);
				
				if ($nsref > 0) {
					
					$bbsref = "SELECT id_referidos FROM referidos WHERE id_usuarios3 ='".$referido."';";
					$ccsref = mysqli_query($conn,$bbsref);
					$dsref = mysqli_fetch_array($ccsref);
					$isref = "INSERT INTO subreferidos(id_usuarios9,id_subreferidos) VALUES('".$dbuc['id_usuarios']."','".$dsref['id_referidos']."');";
					$qisref = $conn->query($isref);
				}

			}
		}
		
		
		

		if ($cibuc = mysqli_query($conn,$ibuc)) {
			


			session_start();


			$bus = "SELECT correo,contra,id_usuarios FROM usuarios WHERE correo ='$cor' AND contra = '$cont';";

			$res = mysqli_query($conn,$bus);
			$result = mysqli_fetch_array($res);
			if ($result['correo'] == $cor && $result['contra'] == $cont){
				$_SESSION['loggedin'] = true;
				$_SESSION['id_usuarios'] = $result['id_usuarios'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (60*60*12);
				header('Location: ../inicio.php');
	
			}
			else {
				header('Location: ../regitro.php');
				die;
			}

			mysqli_close($conn);



		}else{ echo "no agrego puntos";}

	
		}else{echo'No se pudo registrar';}

	}
mysqli_close($conn);
?>

