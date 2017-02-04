<?php
 session_start();
include("../Conexion/conexion.php");
$usuario = $_SESSION['username'];
$id=$_GET['estado'];

$sql = mysqli_query($conexion,"SELECT * from cliente WHERE Cli_Estado = 1 and IdCliente = '$id'"); 
 if($compara = mysqli_fetch_array($sql)){
 $actualiza = "UPDATE cliente set Cli_Estado = 2 WHERE IdCliente = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}else{
 $actualiza = "UPDATE cliente set Cli_Estado = 1 WHERE IdCliente = '$id'";
 mysqli_query($conexion,$actualiza);
 header('location:index.php');
}

header('location:index.php');

?>