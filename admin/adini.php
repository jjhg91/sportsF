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

	<title>admin</title>
	<link rel="stylesheet" type="text/css" href="adcss/adminheader.css">
</head>

<body>
<?php include('adminheader.php') ?>

<section>
	hola
</section>







</body>
</html>