<?php
$q = $_GET["q"];
include('conexion.php');
include('acceso.php');
mysql_select_db($database_demo, $demo);
$query_lista = "SELECT * FROM detalle WHERE id_seccion = ".$q." AND estado = 1 ORDER BY id ASC";
$lista = mysql_query($query_lista, $demo) or die(mysql_error());
$row_lista = mysql_fetch_assoc($lista);
$totalRows_lista = mysql_num_rows($lista);

if($totalRows_lista > 0 ){
echo '<ul id="listar">';
      do { 
echo '<li><a href="actualizar_detalle.php?id='.$row_lista['id'].'">'.$row_lista['titulo'].'</a></li>';
     } while ($row_lista = mysql_fetch_assoc($lista)); 
    mysql_free_result($lista);
echo '</ul>';
} else {
echo 'La consulta no tiene resultados';
} 
?>