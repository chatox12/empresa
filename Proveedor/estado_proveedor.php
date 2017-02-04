<?php
 session_start();
include("../Conexion/conexion.php");
$usuario = $_SESSION['username'];
$id=$_GET['estado'];

$sql = mysqli_query($conexion,"SELECT * from proveedor WHERE Prov_Estado = 1 and idProveedor = '$id'"); 
 if($compara = mysqli_fetch_array($sql)){
 $actualiza = "UPDATE proveedor set Prov_Estado = 2 WHERE idProveedor = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}else{
 $actualiza = "UPDATE proveedor set Prov_Estado = 1 WHERE idProveedor = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}

header('location:index.php');

?>