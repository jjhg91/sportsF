<?php
session_start();

include("conn.php");
$user = $_POST['email'];
$pass = $_POST['pass']; 

$bus = "SELECT correo,contra,id_usuarios FROM usuarios WHERE correo ='$user' AND contra = '$pass';";

$res = mysqli_query($conn,$bus);
$result = mysqli_fetch_array($res);
if ($result['correo'] == $user && $result['contra'] == $pass){
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
?>