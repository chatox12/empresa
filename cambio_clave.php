<?php 
	     session_start();
		include("Conexion/conexion.php");
	
		$user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html>

<head>
<title>Cambio Clave</title>
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
						<h3 class="panel-title"><center>Cambio de Clave al Usuario: <?php echo "<strong>".$user."<strong>" ?></center></h3>
					</div>
					
						<table width="60" border="0" class="table">
		
							<tr>
								<td>	
									<form action="	" method="post" name="formulario">
										  <label>Contraseña Antigua: </label><input type="password" name="passviejo" id="passviejo" class="input-block-level">
										  <label>Nueva Contraseña: </label><input type="password" name="passnuevo" id="passnuevo" class="input-block-level">
										  <label>Repita Nueva Contraseña: </label><input type="password" name="passconfirmar" id="passconfirmar" class="input-block-level"><br><br>
										   <input type="submit" name="button" id="button" class="btn btn-primary" value="Actualizar Contraseña">
						
									</form>
								
									<?php
										if(!empty($_POST['passviejo']) and !empty($_POST['passnuevo']) and !empty($_POST['passconfirmar'])){
											if($_POST['passnuevo'] == $_POST['passconfirmar']){
												$vieja = $_POST['passviejo'];
												$can=mysqli_query($conexion,"SELECT * FROM usuario WHERE (Usu_Usu='".$user."') and (Usu_Contra='".$vieja."')");
													if($dato=mysqli_fetch_array($can)){
														$nueva = $_POST['passconfirmar'];
														$sql = "UPDATE usuario SET usu_Contra = '$nueva', usu_Ingreso='old' WHERE Usu_Usu = '$user'";
														 $verificador =	mysqli_query($conexion,$sql);
														 	
															echo '<div class="alert alert-success">
																  <button type="button" class="close" data-dismiss="alert">X</button>
																  <strong>Contraseña!</strong> Actualizada con exito
																  </div>';
																header('location:index.php');
													
													}else{
														echo '<div class="alert alert-error">
																<button type="button" class="close" data-dismiss="alert">×</button>
																<strong>CLAVE!</strong> Digitada no corresponde a la Antigua
															  </div>';
													}
											
											
											}else{
												echo '<div class="alert alert-error">
													<button type="button" class="close" data-dismiss="alert">×</button>
													<strong>CLAVE!</strong> Las Claves no son Iguales
												  </div>';										
											}
										}
									
									?>	
								
								
								</td>
							</tr>
						
					   </table>
										
			</div>
		</div>
	</div>

</div>





</body>
</html>