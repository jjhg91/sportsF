<?php 

	include("../../php/conn.php");
	

	$busca = $_POST["buscar_u"];


	$qbus=$conn->query("SELECT id_usuarios FROM usuarios WHERE usuario LIKE '%$busca%';");


	$abus=$qbus->fetch_array(MYSQLI_ASSOC);

	if ($abus) {
		header('location: ../usuario.php?usr='.$abus["id_usuarios"].'&id=perfil');
	}










 ?>