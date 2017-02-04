<?php 

#$conectar;
#function conexion_bd(){
#	global $conectar;
$Server = 'localhost';
$User = 'root';
$Pass = '';
$bd = 'empresa';
#$conectar = mysql_connect($Server, $User,$Pass) or die ("Error ". mysql_errno());
#mysql_select_db($bd,$conectar) or die ("Error ". mysql_errno());
#}

$conexion = mysqli_connect($Server, $User, $Pass,$bd) or die("Error" . mysqli_errno($conexion));



?>