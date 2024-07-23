<?php
$q = $_GET["q"];
include('conexion.php');
include('acceso.php');
mysql_select_db($database_demo, $demo);
$query_lista = "SELECT * FROM secciones WHERE id_pag = '".$q."' ORDER BY id_section ASC";
$lista = mysql_query($query_lista, $demo) or die(mysql_error());
$row_lista = mysql_fetch_assoc($lista);
$totalRows_lista = mysql_num_rows($lista);

if($totalRows_lista > 0 ){
echo '<select name="seccion">';
      do { 
echo '<option value="'.$row_lista['id_section'].'">'.$row_lista['titulo'].'</option>';
     } while ($row_lista = mysql_fetch_assoc($lista)); 
    mysql_free_result($lista);
echo '</select>';
} else {
    echo 'La consulta no tiene resultados';
} 
?>