<?php
    foreach ($_FILES as $key) {
    if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      $nombre = $key['name'];//Obtenemos el nombre del archivo
      $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
      $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
      //move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
      //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
       $resultado = carga_imagen($temporal,$nombre);
       echo $resultado;
    }else{
      echo $key['error']; //Si no se cargo mostramos el error
    }
    }

         
function carga_imagen ($img,$nombre){
    $archivos_disp_ar = array('jpg', 'jpeg', 'gif', 'png');
    $carpeta = "img";
    $array_nombre = explode('.',$nombre);
    $cuenta_arr_nombre = count($array_nombre);
    $extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
   
  if(!in_array($extension, $archivos_disp_ar))$error = "Este tipo de archivo no es permitido";
  
  if(empty($error)){
    $img_original = imagecreatefromjpeg($img);
	$max_ancho = 200;
	$max_alto = 180;
	
	list($ancho,$alto)=getimagesize($img);
	
	$x_ratio = $max_ancho / $ancho;
	$y_ratio = $max_alto / $alto;
	
	if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
		$ancho_final = $ancho;
		$alto_final = $alto;
	}
	elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	}
	else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}
	$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
	imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	imagedestroy($img_original);
	$calidad=95;
	$nuevo_mini = time().'_'.rand(0,100).'.'.$extension;
	$nuevo_mini_carpeta = '../'.$carpeta.'/'.$nuevo_mini;
	imagejpeg($tmp,$nuevo_mini_carpeta,$calidad); 
    chmod($nuevo_mini_carpeta,0777);
    return $nuevo_mini;
    }
}

?>