<?php 
include("../../php/conn.php");

$dep  = $_GET['deporte'];
$deport = $_POST['deport'];
$liga = $_POST['liga'];






$buc = "SELECT ligas FROM ligas WHERE ligas = '$liga';";

$cbuc = mysqli_query($conn,$buc);
$nbuc = mysqli_num_rows($cbuc);

if($nbuc > 0 ){
	echo'la liga ya esta registrada';
}else{
	$in = "INSERT INTO ligas(ligas,id_deportes1) VALUES('".$liga."','".$deport."');";
	if($cin = mysqli_query($conn,$in)){
		header('Location: ../liga.php?deporte='.$deport.'');
	}else{echo'hubo un error';}
}



?>