<?php
		session_start();
		include("Conexion/conexion.php");
		

		$act="0";
		
		echo "Hola ". $_SESSION['username'];
?>
