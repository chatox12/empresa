<?php
 session_start();
include("../Conexion/conexion.php");
$usuario = $_SESSION['username'];
$id=$_GET['estado'];

$sql = mysqli_query($conexion,"SELECT * from usuario WHERE Usu_Estado = 1 and IdUsuario = '$id'"); 
 if($compara = mysqli_fetch_array($sql)){
 $actualiza = "UPDATE usuario set Usu_Estado = 2 WHERE IdUsuario = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}else{
 $actualiza = "UPDATE usuario set Usu_Estado = 1 WHERE IdUsuario = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}

header('location:index.php');

?>