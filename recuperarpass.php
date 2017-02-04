<?php
		session_start();
		include("Conexion/conexion.php");
?>
<!doctype html>
<html>
<head>
<title>  </title>
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><center>Reinicio de Clave</center></h3>
				</div>
				<div class="panel-body">
				<form method="post" action="<?php $_SERVER['PHP_SELF'] ?> " name="form1">
			
					<div class="form-group">
						<input type="text" name="usuario" class="input-block-level" placeholder = "Ingrese Usuario . . ." autofocus>				
					</div>
						<button type="submit" class="btn  btn-primary" name="enviar"> <i class="icon-inbox"></i>Enviar</button>
						<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-ban-circle"></i> Cancelar </li></ul></button>
											
						
						<?php 
							if(!empty($_POST['usuario'])){
										$usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
										$usuario = trim($_POST['usuario']);
										$query = mysqli_query($conexion, "SELECT * FROM usuario WHERE Usu_Usu = '".$usuario."'");
											if(mysqli_num_rows($query)){
												$fila = mysqli_fetch_assoc($query);
												$Max_caracteres = 10;
												function generaPass( $longitudPass){
													$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";    
													$longitudCadena=strlen($cadena);   
													$pass = "";
														for($i=1 ; $i<=$longitudPass ; $i++){        
															$pos=rand(0,$longitudCadena-1); 
															$pass .= substr($cadena,$pos,1);
														}
														return $pass;
													}								
												
												$nueva_clave = generaPass($Max_caracteres);
												$usuario = $fila['Usu_Usu']; 
												$enviar_nueva_clave = $nueva_clave;
												$correo =  $fila['Usu_Correo'];
														mysqli_query($conexion,"UPDATE usuario SET Usu_Contra = '".$enviar_nueva_clave."',usu_Ingreso = 'new' WHERE Usu_Usu = '".$usuario."' ");
															$remite = "Sistema en prueba";
															$remite_correo = "chatoxnew12@hotmail.com";
															$asunto="Reinicio de Clave";
															$mensaje="Se ha Generado una nueva clave para el usuario :".$usuario." \n Nueva clave temporal: ". $enviar_nueva_clave;
															$cabecera = "FROM: ".$remite." <".$remite_correo.">\r\n";
															$cabecera = $cabecera."version prueba \n";
															$cabecera = $cabecera."Favor  no responder este Mensaje \n";
														$enviar_correo = mail($correo,$asunto,$mensaje,$cabecera);
															if($enviar_correo){
																echo '<div class="alert alert-success" align="center">
																      <button type="button" class="close" data-dismiss="alert">X</button>
																		Mensaje Enviado <a href="index.php">Ir a inicio</a> </div>';
															}else{
																echo '<div class="alert alert-error" align="center"> 
																      <button type="button" class="close" data-dismiss="alert">X</button>
																	  No se Puedo enviar el Mensaje <a href="index.php">Ir a inicio</a></div>';
															}
			
											}else{
																echo '<div class="alert alert-error" align="center">
																	    <button type="button" class="close" data-dismiss="alert">X</button>
																		Usuario <strong>'.$usuario.'</strong> No esta registrado <a href="index.php">Ir a inicio</a> </div>';
		
											}
		
		}
	
	
	
	
?>	
						
						
				</form>
				</div>
			</div>
		</div>
	</div>
</div>









</body>
</html>