<?php
 session_start();
include("../Conexion/conexion.php");
$usuario = $_SESSION['username'];
$id=$_GET['estado'];

$sql = mysqli_query($conexion,"SELECT * from producto WHERE Pro_Estado = 1 AND idProducto = '$id'"); 
 if($compara = mysqli_fetch_array($sql)){
 $actualiza = "UPDATE producto SET Pro_Estado = 2 WHERE idProducto = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}else{
 $actualiza = "UPDATE producto SET Pro_Estado = 1 WHERE idProducto = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}
header('location:index.php');

?>