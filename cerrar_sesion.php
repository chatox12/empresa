<?php 

session_start();
include("Conexion/conexion.php");
$can=mysqli_query($conexion,"SELECT * FROM usuario WHERE (Usu_Usu='".$_SESSION['username']."')");
if($dato=mysqli_fetch_array($can)){
		$id = $dato['IdUsuario'];
}
$fecha = date('Y-m-d H:i:s');
mysqli_query($conexion,"UPDATE user_log SET Log_FechaLogout = NOW() WHERE Log_Usuario='$id'") or die(mysqli_error());
session_unset();
session_destroy();
header("location:index.php");	
?>