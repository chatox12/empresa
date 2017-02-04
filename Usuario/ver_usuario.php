<?php 
 session_start();
include("../Conexion/conexion.php");
$Mostar = 10;
if(isset($_GET['pag'])){
$reg_Empezar = ($_GET['pag'] - 1) * $Mostar;
$PagAct = $_GET['pag'];

}else{
$reg_Empezar =  0;
$PagAct = 1;
}
?> 
<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/docs.css" rel="stylesheet">
    <link href="../js/google-code-prettify/prettify.css" rel="stylesheet">
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="../funciones/validar.js"></script>
	
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="../js/jquery.js"></script>
    <script src="../js/bootstrap-transition.js"></script>
    <script src="../js/bootstrap-alert.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-dropdown.js"></script>
    <script src="../js/bootstrap-scrollspy.js"></script>
    <script src="../js/bootstrap-tab.js"></script>
    <script src="../js/bootstrap-tooltip.js"></script>
    <script src="../js/bootstrap-popover.js"></script>
    <script src="../js/bootstrap-button.js"></script>
    <script src="../js/bootstrap-collapse.js"></script>
    <script src="../js/bootstrap-carousel.js"></script>
    <script src="../js/bootstrap-typeahead.js"></script>
    <script src="../js/bootstrap-affix.js"></script>
    <script src="../js/holder/holder.js"></script>
    <script src="../js/google-code-prettify/prettify.js"></script>
    <script src="../js/application.js"></script>
	
	
	</head>


<body data-spy="scroll" data-target=".bs-docs-sidebar">


<table width="100%" border="0" class="table table-hover" >
	<tr>
		<td>
			<div class="btn-group" data-toggle="buttons-checkbox">
				<button type="button" class="btn btn-primary" onClick="window.location='nuevo_usuario.php'"> Nuevo Usuario</button>	
			</div>
		</td>
		
		<td>
			<div align="right">
				<form method="post"  action="" name="formulario" id="formulario" enctype="multipart/form-data">
				
						 <div class="input-append">
							<input  name="buscar" id="buscar" class="span2"  type="text" size="70" list="characters" autocomplete="off">
								<datalist id="characters">
									<?php
										$buscar = $_POST['buscar'];
										$sql =  "SELECT * FROM usuario ORDER BY Usu_Nombre";
										$result = mysqli_query($conexion,$sql);														
										while($aux =  mysqli_fetch_array($result)){
											echo '<option value="'.$aux['Usu_Nombre'].'">';
																			
										}
									?>
								
								 </datalist>
							<button class="btn" type="submit"> <i class="fa fa-search"> </i> </button>
						</div>
					</form>
			</div>
		</td>
	
	</tr>
	<tr class="info">	<td colspan="3">	<center> <strong>LISTADO DE USUARIOS</strong></center>	</td>	</tr>

</table>

<div align="center">
	<table  width="80%" border="0"class="table table-striped table-bordered  table-hover">
		
		<thead>
		<tr>
			<th width="5%"><strong>No.</strong></th>
			<th width="27%"><strong>Nombre Completo</strong></th>
			<th width="13%"><strong>Usuario</strong></th>
			<th width="23%"><strong>Correo</strong></th>
			<th width="13%"><strong>Tipo de Usuario</strong></th>
			<th width="11%"><strong>Estado</strong></th>
			<th width="8%"><strong></strong></th>
		</tr>
		</thead>
		<?php 
			if(empty($_POST['buscar'])){
			$sql =  "SELECT * FROM usuario ORDER BY Usu_Nombre LIMIT $reg_Empezar,$Mostar";
			}else{
			$buscar = $_POST['buscar'];			
			$sql =  "SELECT * FROM usuario WHERE Usu_Nombre LIKE '%$buscar%' ORDER BY Usu_Nombre LIMIT $reg_Empezar,$Mostar ";			
			}
			$result = mysqli_query($conexion,$sql);
			if($final = mysqli_num_rows($result) > 0){
			$aux1 = 0;	
			
			while($aux = mysqli_fetch_array($result)){			
									$id = $aux['Usu_Estado']; 									
									$resultado_esta = mysqli_query($conexion,"SELECT Est_Nombre FROM estado where IdEstado = '$id'");
									if($estado = mysqli_fetch_array($resultado_esta))
									$esta= $estado['Est_Nombre'];				
			if($aux['Usu_Estado']==1){		
      			$estado='<span class="label label-success">'.$esta.'</span>';
			}else{
				$estado='<span class="label label-important">'.$esta.'</span>';
			}
				
		?>
		<tr>
			<td width="5%"><?php echo $aux1 + 1 ?></td>
			
			<td width="27%"><?php echo $aux['Usu_Nombre']." ".$aux['Usu_Apellido']?></td>
			<td width="13%"><?php echo $aux['Usu_Usu'] ?></td>
			<td width="23%"><?php echo $aux['Usu_Correo'] ?></td>
			<td width="13%"><?php 
									 $id = $aux['Usu_TipoUsuario']; 									
									$resultado_nom = mysqli_query($conexion,"SELECT IdTipoUsuario, Tip_Nombre FROM tipousuario where IdTipoUsuario = '$id'");
									if($tipo = mysqli_fetch_array($resultado_nom))
									$nom=$tipo['Tip_Nombre'];      								
									   echo $nom;									
									?></td>
			<td width="11%"><a href="estado_usuario.php?estado=<?php echo $aux['IdUsuario'] ?>" ><?php echo $estado; ?></a></td>
			
			<td width="8%"><a href="modificar_usuario.php?modificar=<?php echo $aux['IdUsuario']?>" > <img src="../img/editar.png" width="15" height="15"> Editar</a></td>
			
		
		</tr>
			<?php
			$aux1++;
				}  }else{
				 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>No hay datos! </strong></div>';
				}
			
			?>
		</table>
		<table  width="80%" border="0"class="table">
		<tr>
		<td colspan="7"><center>
			
		<?php
			
				$totalDatos = mysqli_num_rows( mysqli_query($conexion,"SELECT * FROM usuario") );
					$PagAnt = $PagAct - 1;
					$PagSig = $PagAct + 1;
					$PagUlt = $totalDatos / $Mostar; 					
					$Res = $totalDatos / $Mostar; 					
					if($Res > 0) $PagUlt  = floor( $PagUlt ) + 1;
					 echo " <ul class='pager'>  
					 		<li>	<a onclick=\"Pagina('1')\">Primero </a>  </li> ";
					 if($PagAct>1) 
					 		echo " <li> <a onclick=\"Pagina('$PagAnt')\"> Anterior </a> </li>";
					 echo "<strong>Pagina ".$PagAct." - ".$PagUlt."</strong>";
					 if($PagAct<$PagUlt)  
					 		echo " <li> <a onclick=\"Pagina('$PagSig')\"> Siguiente </a> </li>";
					 echo "<li> <a onclick=\"Pagina('$PagUlt')\"> Ultimo</a> </li>  </ul> ";									
				
		?>
		
	</td>
	
	</tr>
		</table>

</div>

</body>

</html>