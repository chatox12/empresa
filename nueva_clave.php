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
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
	
	<script type="text/javascript" src="funciones/validar.js"></script>
	
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
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
    <script src="js/bootstrap-affix.js"></script>
    <script src="js/holder/holder.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/application.js"></script>
</head>
<body>
	<table width="60" border="0" class="table">
		<tr class="info">
			<td colspan="2"><center> <strong>Nueva Clave </strong></center></td>
		</tr>
		<tr>
			<td>	
				<form action="	" method="post" name="formulario">
					  <label>Contraseña Antigua: </label><input type="password" name="passviejo" id="passviejo">
      				  <label>Nueva Contraseña: </label><input type="password" name="passnuevo" id="passnuevo">
      				  <label>Repita Nueva Contraseña: </label><input type="password" name="passconfirmar" id="passconfirmar"><br><br>
      				   <input type="submit" name="button" id="button" class="btn btn-primary" value="Actualizar Contraseña">
    
				</form>
			</td>
			<td>
				<?php
					if(!empty($_POST['passviejo']) and !empty($_POST['passnuevo']) and !empty($_POST['passconfirmar'])){
						if($_POST['passnuevo'] == $_POST['passconfirmar']){
							$vieja = $_POST['passviejo'];
							$can=mysqli_query($conexion,"SELECT * FROM usuario WHERE (Usu_Usu='".$user."') and (Usu_Contra='".$vieja."')");
								if($dato=mysqli_fetch_array($can)){
									$nueva = $_POST['passconfirmar'];
									$sql = "UPDATE usuario SET usu_Contra = '$nueva' WHERE Usu_Usu = '$user'";
									 mysqli_query($conexion,$sql);
										echo '<div class="alert alert-success">
					  						  <button type="button" class="close" data-dismiss="alert">X</button>
					                          <strong>Contraseña!</strong> Actualizada con exito
					                          </div>';
				
								}else{
									echo '<div class="alert alert-error">
					  						<button type="button" class="close" data-dismiss="alert">×</button>
					  						<strong>CLAVE!</strong> Digitada no corresponde a la antigua
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



</body>
</html>