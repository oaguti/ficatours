<?php 
/*incluimos el header*/
include('header.php');
//////////////////////////////////////////
$editFormAction = $_SERVER['PHP_SELF'];

if ((isset($_GET['action']))) {
    $tipo = $_GET['action'];
    $insertSQL = "UPDATE paginas SET estado = 0 WHERE id_pag = '".$tipo."'"; 
    mysql_select_db($database_demo, $demo);
	$Result1 = mysql_query($insertSQL, $demo) or die(mysql_error());
    
    echo '<script type="text/javascript">alert("PAGINA ELIMINADA");</script>';
    }
    
/////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT id_pag,titulo FROM paginas WHERE id_destino = ".$destino_received." ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
mysql_close($demo);
?>
<section>
<h1 id="titleDestination"></h1>
<br/><br/>
<p><strong>Listado de paginas a eliminar</strong></p><br />
  <ul id="listar">
     <?php do { ?>
    <li><a href="listar_paginas_eliminar.php?action=<?php echo $row_menu['id_pag']; ?>"><?php echo $row_menu['titulo']; ?></a></li>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    ?>
  </ul>
<br /><br />
</section>
<script src="js/destino.js"></script>
</body>
</html>