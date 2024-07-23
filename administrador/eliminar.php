<?php
//obteniendo las variables enviadas  
$tipo =  $_GET['action'];
$tabla = $_GET['tabla'];
$registro = $_GET['pos'];
$url = $_SERVER['HTTP_REFERER'];
//realizando conexion y consulta a BD
require_once('conexion.php');
mysql_select_db($database_demo, $demo);
$query_Recordset1 = "UPDATE ".$tabla." SET estado = 0 WHERE ".$registro." = '".$tipo."'";
mysql_query($query_Recordset1, $demo) or die(mysql_error());
mysql_close($demo);
echo '<script type="text/javascript">alert("El producto fue borrada"); location.href="'.$url.'";</script>';
?>