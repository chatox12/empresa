<?php
  include('Barcode.php');
  
   $fontSize = 10;   // GD1 in px ; GD2 in point
   $marge    = 10;   // between barcode and hri in pixel
  //$x        = $_POST['x'];  // barcode center
  //$y        = $_POST['y'];  // barcode center
  //$height   = $_POST['height'];   // barcode height in 1D ; module size in 2D
  //$width    = 2;    // barcode height in 1D ; not use in 2D
  //$angle    = $_POST['angle'];   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
		  
  $code     = $_GET['numero']; // barcode, of course ;)
  //$type     = $_POST['tipo'];
  $x = '150';
  $y = '50';
  $height = '50';
  $width= '2';
  $angle = '0';
 //$code = '12345';
  $type ='code128';
  $ancho='320';
  $largo='100';
  
  
  
  function drawCross($im, $color, $x, $y){
    imageline($im, $x - 10, $y, $x + 10, $y, $color);
    imageline($im, $x, $y- 10, $x, $y + 10, $color);
  }
  
  ########## ancho largo ##################33
  $im     = imagecreatetruecolor($ancho, $largo);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  imagefilledrectangle($im, 0, 0,$ancho, $largo, $white);
  
  $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  if ( isset($font) ){
    $box = imagettfbbox($fontSize, 0, $font, $data['hri']);
    $len = $box[2] - $box[0];
    Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
    imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
  }
  if('v'=='i'){
	  imagegif($im,$code.'.gif');
	  imagedestroy($im);  
	  
	#  header('Location: index.php');
  }else{
	  header('Content-type: image/gif');
	  imagegif($im);
	  imagedestroy($im);  
  }

?>