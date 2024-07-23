<?php
include('conexion.php');
include('acceso.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="og" />
	<title>ADMINISTRADOR DE CONTENIDOS - PLASTITECNICA</title>
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
    <script src="ckeditor/ckeditor.js"></script>
    <link href="ckeditor/sample/sample.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    	$('ul#menu li ul').hide();
    	$('ul#menu li').hover(
    			//Funcion Hover
    			function(){
    				//Escondemos otros menus
    				$('ul#menu li').not($('ul', this)).stop();
    					// Mostramos el men&uacute; que corresponde
    				$('ul', this).slideDown('fast');
    			},
    			//OnOut
    			function(){
    				// Hide Other Menus
    				$('ul', this).slideUp('fast');
    			}
    	);
    
    });
    </script>
</head>

<body>
<header>
</header>
<ul id="menu">
    <li><a href="datos.php">Datos de la empresa</a></li>
	<li><a href="#">Paginas</a>
        <ul>
            <li><a href="listar_paginas.php">Agregar pagina</a></li>
            <li><a href="listar_paginas_eliminar.php">Eliminar pagina</a></li>
            <li><a href="agregar_seccion_c.php">Agregar contenido</a></li>
            <li><a href="editar_seccion_c.php">Editar contenido</a></li>
            <li><a href="agregar_boton.php">Agregar y Editar boton</a></li>
            <li><a href="eliminar_boton.php">Eliminar boton</a></li>
            
        </ul>
    </li>
    
    <li><a href="#">Secciones</a>
       <ul>
            <li><a href="agregar_seccion_l.php">Agregar seccion </a></li>
            <li><a href="listar_seccion_l.php">Editar seccion </a></li>
            <li><a href="eliminar_seccion_l.php">Eliminar seccion </a></li>
            
       </ul>
    </li>
    <li><a href="#">Detalles</a>
        <ul>
            <li><a href="agregar_cont_lista.php">Agregar detalles</a></li>
            <li><a href="editar_cont_l.php">Editar detalles</a></li>
            <li><a href="eliminar_detalle.php">Eliminar detalles</a></li>
            
       </ul>
    </li>
    <li><a href="#">Imagenes</a>
        <ul>
            <li><a href="agregar_imagen.php">Agregar imagen</a></li>
            <li><a href="eliminar_imagenes.php">Eliminar imagen</a></li>
            
       </ul>
    </li>
    <li><a href="#">Promociones</a>
        
    </li>
    <li><a href="<?php echo $logoutAction ?>">Cerrar sesi&oacute;n</a></li>
</ul>
