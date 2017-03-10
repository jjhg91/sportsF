<?php
session_start();

include("../../php/conn.php");
$user = $_POST['email'];
$pass = $_POST['pass']; 

$bus = "SELECT correo,contra FROM usuarios WHERE correo ='$user' AND contra = '$pass';";

$res = mysqli_query($conn,$bus);
$result = mysqli_fetch_array($res);
if ($result['correo'] == $user && $result['contra'] == $pass){
	$_SESSION['loggedin'] = true;
	$_SESSION['id_usuarios'] = $result['id_usuarios'];
	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (60*60)*24;
	header('Location: ../adini.php');
	
}
else {
	echo "No esta autorizado";;
	die;
}

mysqli_close($conn);
?>