<?php
require('../fpdf/fpdf.php');
require('../../../Conexion/conexion.php');


$pdf = new FPDF();
$pdf->AddPage();


$query_empresa =mysqli_query($conexion, "SELECT * from empresaumg");

		if($aux = mysqli_fetch_array($query_empresa)){
			$sim_codigo = $aux['IdEmpresa'];
			$sim_Nombre = $aux['Emp_Nombre'];
			$sim_NIT = $aux['Emp_NIT'];
			$sim_Direccion = $aux['Emp_Direccion'];
			$sim_Telefono = $aux['Emp_Telefono'];
			$sim_Correo = $aux['Emp_Correo'];
			$sim_Moneda = $aux['Emp_Moneda'];
		}
		
		$fecha = date('d-m-Y');
		
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../recursos/tienda.gif' , 10 ,8, 20 , 25,'GIF');
$pdf->Ln(10);
$pdf->Image('../../../fotos/'.$sim_codigo.'.jpg' , 180 ,8, 20 , 25,'JPG');

$pdf->Ln(10);
$pdf->Cell(200, 10, $sim_Nombre.' NIT: '.$sim_NIT, 0, 0,'C');
$pdf->Ln(5);
$pdf->Cell(200, 10,'Direccion: '.$sim_Direccion,0,0,'C');
$pdf->Ln(5);
$pdf->Cell(200, 10,'Correo: '.$sim_Correo,0,0,'C');
$pdf->Ln(5);
$pdf->Cell(200, 10,'Tel: '.$sim_Telefono,0,0,'C');


$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.$fecha.'', 0);
$pdf->Ln(15);


$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(154, 166, 199);
$pdf->SetTextColor(0);
$pdf->Cell(0, 8, 'LISTADO DE PRODUCTO', 0, 1, 'C', true);
$pdf->Ln(10);


$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(154, 166, 199);
$pdf->Cell(10, 8, 'No.', 'LTR', 0, 'C', true);
$pdf->Cell(25, 8, 'Codigo de barra', 'LTR', 0, 'C', true);
$pdf->Cell(35, 8, 'Nombre', 'LTR', 0, 'C', true);
$pdf->Cell(25, 8, 'Precio Publicos', 'LTR', 0, 'C', true);
$pdf->Cell(30, 8, 'Precio Distribuidor', 'LTR', 0, 'C', true);
$pdf->Cell(16, 8, 'Existencia', 'LTR', 0, 'C', true);
$pdf->Cell(25, 8, 'Marca', 'LTR', 0, 'C', true);
$pdf->Cell(20, 8, 'estado','LTR', 0, 'C', true);
$pdf->Ln(10);

$result= mysqli_query($conexion,"SELECT pro.Pro_BarCode, pro.Pro_Nombre, pro.Pro_venta, pro.Pro_Mayor, pro.Pro_Stock, mar.Mar_Nombre, est.Est_Nombre
FROM producto pro 
INNER JOIN marca mar ON pro.Pro_Marca = mar.IdMarca
INNER JOIN estado est ON pro.Pro_Estado = est.IdEstado ORDER BY pro.Pro_Stock;");
$item = 0;
$totaluni = 0;
$totaldis = 0;
$cant = 0;

while($productos2 = mysqli_fetch_array($result)){
	$item = $item+1;
	$pintar = $item%2;
	
	if ((!$pintar==0)) { 
        	$color="#CCCCCC"; 
   		}else{ 
        	$color="#FFFFFF";
   		}
		
	$totaluni = $totaluni + $productos2['Pro_venta'];
	$totaldis = $totaldis + $productos2['Pro_Mayor'];
	$cant     = $cant     + $productos2['Pro_Stock'];
	
	$pdf->Cell(10, 8,$item,1, 0, 'L',false); 
	$pdf->Cell(25, 8,$productos2['Pro_BarCode'],1, 0, 'L',false);//Para codigo producto
	$pdf->Cell(35, 8, $productos2['Pro_Nombre'], 1, 0, 'L',false);//para Nombre producto
	$pdf->Cell(25, 8, $sim_Moneda.'. '.number_format($productos2['Pro_venta'],2,".",","),1, 0, 'C',false);
	$pdf->Cell(30, 8, $sim_Moneda.'. '.number_format($productos2['Pro_Mayor'],2,".",","),1, 0, 'C',false);
	$pdf->Cell(16, 8, $productos2['Pro_Stock'],1, 0, 'C',false);
	$pdf->Cell(25, 8, $productos2['Mar_Nombre'], 1, 0, 'L',false);
	$pdf->Cell(20, 8, $productos2['Est_Nombre'], 1, 0, 'C',false);
	$pdf->SetFillColor(238); 
    $pdf->SetLineWidth(0.2); 
    $fill = false;
	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(10,8,'TOTALES:                                                                '.$sim_Moneda.number_format($totaluni,2,".",",").'                 '. $sim_Moneda.number_format($totaldis,2,".",",").'                         '.$cant,0);

#$pdf->Output('productos '.$fecha.'.pdf','d');
$pdf->Output();

?>