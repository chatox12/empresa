<?php
		session_start();
		include("Conexion/conexion.php");

		$act="0";
?>

<html>
<head> <title>INICIO DE SESION</title>
<meta charset="UTF-8" />
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
      body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
	background-image: url(img/);
      }

      .form-signin {
        }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
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


<!DOCTYPE html>

<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			  <div class="login-panel panel panel-default">		
				<div class="panel-heading">
					<h3 class="panel-title"><center><i class="icon-lock"></i>Inicar Sesion</center></h3>
				</div>
				<div class="panel-body">
					<form name="form1" method="post" action="" class="form-signin" role= "form">
					
						<fieldset>
							<div class="form-group">
								<input type="text" name="user" class="input-block-level" placeholder = "Usuario" autofocus>
							</div>
							<div class="form-group">
								<input type="password" name="pass" class="input-block-level" placeholder = "Contrase&#241a" >
							</div>
							 
								<button title="Haga clic aqui para iniciar Sesion" class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
							
							
                                    <label>
                                        <a href="recuperarpass.php"><i class="icon-repeat"></i> Olvidaste tu clave?</a>
                                    </label>
                            	
								<?php
									$act="1";
										if(!empty($_POST['user']) and !empty($_POST['pass'])){
											$usuario=trim($_POST['user']);
											$contra=trim($_POST['pass']);
											$can=mysqli_query($conexion,"SELECT * FROM usuario WHERE (Usu_Usu='".$usuario."') and (Usu_Contra='".$contra."') and (Usu_Estado = 1)");
												if($dato=mysqli_fetch_array($can)){
													$_SESSION['tipo_usu']=$dato['Usu_TipoUsuario'];
													$_SESSION['username']=$dato['Usu_Usu'];
															$nuevo = $dato['usu_Ingreso'];
															$id = $dato['IdUsuario'];
															if($nuevo == 'new'){
																header('location:cambio_clave.php');
																}else{
																	if($_SESSION['tipo_usu']=='1'){ 
																		header('location:principal.php');
																		mysqli_query($conexion,"INSERT INTO user_log (Log_Usuario, Log_FechaLogin) VALUES ('$id',NOW())");
																	}
																	elseif($_SESSION['tipo_usu']=='2'){ 
																		header('location:recibidos.php');
																		mysqli_query($conexion,"INSERT INTO user_log (Log_Usuario, Log_FechaLogin) VALUES ('$id',NOW())");
																	}else{
																	if($act=="1"){
																		echo '<div class="alert alert-error" align="center">Usuario y Contraseña Incorrecta</div>';
																	}else{
																		$act="0";
																	}
																}
															}
																
												}
										}
							?>
	
						</fieldset>
					</form>
				</div>
			</div>
	</div>
</div>





</body>
</html>
