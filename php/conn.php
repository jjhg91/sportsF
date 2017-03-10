<?php
include("dato.php");

$conn= mysqli_connect($server,$us,$ps,$db);
$conn->query("SET NAMES 'utf8'");
if( $conn === false )
{
     echo "Unable to connect.</br>";
 
}/*else{
	echo "CONECTADO";
}*/
?>
