<?php
/*incluimos el header*/
include('conexion.php');
$id = $_GET['q'];
mysql_select_db($database_demo, $demo);
$query_galeria = "SELECT * FROM galeria WHERE id_pag = '".$id."' AND estado = '1' ORDER BY id ASC";
$galeria = mysql_query($query_galeria, $demo) or die(mysql_error());
$row_galeria = mysql_fetch_assoc($galeria);
$totalRows_galeria = mysql_num_rows($galeria);
//////////////////////////////////////////////
if($totalRows_galeria > 0){
echo '<h1>Imagenes de la pagina :</h1><br/>';
echo '<ul class="lista_gal">';
  do { 
echo    '<li>';
echo    '<img src="../img/'.$row_galeria['img'].'" width="200" height="180" /><br/>';
echo    '<p><a href="eliminar.php?action='.$row_galeria['id'].'&data=galeria&pos=id">Eliminar</a></p>';        
echo    '</li>';
        } while ($row_galeria = mysql_fetch_assoc($galeria));
echo '</ul>';
mysql_free_result($galeria);
} else {
echo '<p>La pagina no contiene imagenes.</p>';    
} 
?>