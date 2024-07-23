<?php
include('conexion.php');
include('acceso.php');
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $id = $_POST['id'];
    $url = "listar_paginas.php"; 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $query_Recordset1 = "UPDATE paginas SET estado = '".$estado."', titulo = '" . htmlentities($titulo) . "', tipo = '". htmlentities($tipo)."'  WHERE id_pag = '".$id."'";    
    mysql_select_db($database_demo, $demo);
	$Recordset1 = mysql_query($query_Recordset1, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("La pagina fue actualizada"); location.href="'.$url.'";</script>';
?>