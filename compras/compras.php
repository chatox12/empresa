<?php 
 	session_start();
	include("../Conexion/conexion.php")
 ?>

<!DOCTYPE html>
<html>
<head>

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
				<button type="button" class="btn btn-primary" onClick="window.location='Nueva_compra.php'"> Nueva Compra</button>	
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
										$sql =  "SELECT * FROM Producto ORDER BY IdProducto";
										$result = mysqli_query($conexion,$sql);
														
										while($aux =  mysqli_fetch_array($result)){
											echo '<option value="'.$aux['Pro_Nombre'].'">';
											
										
										}
									?>
								
								 </datalist>
							<button class="btn" type="submit"> <i class="fa fa-search"> </i> </button>
						</div>
					</form>
			</div>
		</td>
	
	</tr>
	<tr class="info">	<td colspan="3">	<center> <strong>COMPRAS REALIZADAS</strong>
	</center>	</td>	</tr>

</table>

<div align="center">
	<table  width="80%" border="0"class="table table-striped table-bordered  table-hover">
		
		<thead>
		<tr>
			<th width="5%"><strong>No.</strong></th>
			<th width="20%"><strong>Fecha de Compra</strong></th>
			<th width="16%"><strong>Producto</strong></th>
			<th width="24%"><strong>Proveedor</strong></th>
			<th width="15%"><strong>Marca</strong></th>
            <th width="15%"><strong>Categoria</strong></th>
            
			
		</tr>
		</thead>
		<?php 
			if(empty($_POST['buscar'])){
			$sql =  "SELECT * FROM Producto ORDER BY IdProducto";
			}else{
			$buscar = $_POST['buscar'];			
			$sql =  "SELECT * FROM Producto WHERE Pro_Nombre LIKE '%$buscar%' ORDER BY IdProducto";			
			}
			$result = mysqli_query($conexion,$sql);
			if($final = mysqli_num_rows($result) > 0){
			$aux = 0;	
			while($aux = mysqli_fetch_array($result)){
			
									$id = $aux['idProducto']; 									
				$resultado_cli = mysqli_query($conexion,"SELECT Compras.idCompras, Compras.com_fecha, Producto.Pro_Nombre,Proveedor.Prov_Nombre,Marca.Mar_Nombre,Categoria.Cat_Nombre from Producto inner JOIN Compras on Producto.idProducto = Compras.Producto_idProducto inner JOIN Proveedor on Producto.Pro_Proveedor = Proveedor.idProveedor inner JOIN Marca on Marca.IdMarca = Producto.Pro_Marca inner JOIN Categoria on Categoria.IdCategoria = Producto.Pro_Categoria Order by Compras.idCompras DESC" );
									//if($cliente = mysqli_fetch_array($resultado_cli))
									//$cli= $cliente['idProducto'];									
						while($fila=mysqli_fetch_array($resultado_cli)){

		?>
		<tr>
			<td width="5%"><?php echo $fila['idCompras']?></td>
			<td width="5%"><?php echo $fila['com_fecha']?></td>
			<td width="5%"><?php echo $fila['Pro_Nombre']?></td>
			<td width="5%"><?php echo $fila['Prov_Nombre']?></td>
			<td width="5%"><?php echo $fila['Mar_Nombre']?></td>
			<td width="5%"><?php echo $fila['Cat_Nombre']?></td>
		</tr>					
   <?php 
}
  ?>
 				
									
									
		    				
		
		
		
			
		<?php
			#$aux++;
				}  }else{
				 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>No hay datos! </strong></div>';
				}
		?>
		
	</table>

</div>

</body>

</html>


