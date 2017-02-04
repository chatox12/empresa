<?php
		session_start();
		include("Conexion/conexion.php");
			if(!$_SESSION['tipo_usu'] == '1'){
			header('location:index.php');
			}	

?>


<!DOCTYPE html>
<html>
<head>
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
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<div align="center">
<table width="80%" border="0">
	<tr>
		<td>
			<div id="navbar-example" class="navbar navbar-static">
				<div class="navbar-inner">
					<div class="container" style="width:auto">
						<a class="brand" href="ayuda/inicio.php" target="admin">Inicio</a>
						
						<ul class="nav"  role="navigation">
							 <li class="dropdown">
              					<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Ventas <b class="caret"></b></a>
              						<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="cuerpo.php" target="admin">Nota de Envio</a></li>
                						
              						</ul>
            				  </li>
							
							<li class="dropdown">
							</li>
						</ul>
						<ul class="nav"  role="navigation">
							 <li class="dropdown">
              					<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
              						<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="reportes/fpdf/vistas/productospdf.php" target="admin">Productos pdf</a></li>
                						
              						</ul>
            				  </li>
							
							<li class="dropdown">
							</li>
						</ul>
						<ul class="nav"  role="navigation">
							 <li class="dropdown">
              					<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Mantenimiento <b class="caret"></b></a>
              						<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="Usuario/index.php" target="admin">Usuario</a></li>
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="Proveedor/index.php" target="admin">Proveedor</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/estado.php" target="admin">Estado</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="Cliente/index.php" target="admin">Cliente</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/tipo_Usuario.php" target="admin">Tipo Usuario</a></li>
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/categoria_Cliente.php" target="admin">Categoria Cliente </a></li>										<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/nueva_marca.php" target="admin">Marcas</a></li>
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/nueva_categoria.php" target="admin">Categoria Producto</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/nueva_Subcategoria.php" target="admin">SubCategoria Producto</a></li>
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="Complementos/nueva_UnidadMedida.php" target="admin">Unidad de Medida</a></li>
                						<li role="presentation"><a role="menuitem" tabindex="-1" href="producto/index.php" target="admin">Producto</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="Empresa/index.php" target="admin">Empresa</a></li>
                						
              						</ul>
            				  </li>
							
							<li class="dropdown">
							</li>
						</ul>
						<ul class="nav pull-right">
            				<li id="fat-menu" class="dropdown">
              					<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Bienvenido! <?php echo $_SESSION['username']?><b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">	
								 <li role="presentation"><a role="menuitem" tabindex="-1" href="nueva_clave.php" target="admin"><i class="icon-refresh"></i> Cambiar Contrase&#241a</a></li>
								 <li role="presentation" class="divider"></li>
                				<li role="presentation"><a role="menuitem" tabindex="-1" href="cerrar_sesion.php"><i class="icon-off"></i> Cerrar Sesion</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="ayuda/manual.pdf" target="admin"><i class="icon-heart"></i> Ayuda</a></li>
							</ul>               
              			
                			</li>
        				</ul>
					</div>
				</div>
			
				
			</div>
		</td>
	</tr>
	<tr>
		 <td><iframe src="cuerpo.php" frameborder="0" scrolling="auto" name="admin" width="100%" height="500"></iframe></td>
	</tr>
	<tr>
    <td>
    <pre><center><strong>DATOS DE LA EMPRESA</strong></center></pre>
    </td>
  </tr>

</table>
</div>
</body>
</html>