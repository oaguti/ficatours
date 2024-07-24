<?php 
/*incluimos el header*/
include('header.php');
$_SESSION['destino'] = $destino_received;
//////////////////////////////////////////
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;    
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}
//////////////////////////////////////////
$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $pagina = $_POST['pagina'];
    $tipo = $_POST['tipo'];
    $id_destino =  $_POST['destino'];
    $estado = "0";
    $insertSQL = sprintf("INSERT INTO paginas (titulo,tipo, estado,id_destino) VALUES (%s, %s,%s,%s)",
						  GetSQLValueString(htmlentities($pagina), "text"),
              GetSQLValueString($tipo, "text"),
              GetSQLValueString($estado, "text"),
              GetSQLValueString($id_destino, "int")); 
    mysql_select_db($database_demo, $demo);
	$Result1 = mysql_query($insertSQL, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("PAGINA GUARDADA");</script>';
    }
    
/////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT * FROM paginas WHERE id_destino = ".$destino_received." ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
/////////////////////////////////////////
$query_tipo = "SELECT * FROM tipos WHERE estado = '1' ORDER BY id_tipo ASC";
$tipo = mysql_query($query_tipo, $demo) or die(mysql_error());
$row_tipo = mysql_fetch_assoc($tipo);
$totalRows_tipo = mysql_num_rows($tipo);
mysql_close($demo);
?>
<section>
<h1 id="titleDestination"></h1><br/>
<div style="width: 100%; overflow: hidden;" >
<p><strong>Agregar pagina</strong></p><br />
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="agregar">
  <fieldset>
  <label>Escriba el nombre de la pagina:</label><br/>
  <input type="text" name="pagina" id="nombre" /><br /><br />
  <label>Tipo de pagina:</label>
  <select name="tipo">
      <?php do { ?>
      <option value="<?php echo $row_tipo['id_tipo']; ?>" ><?php echo ($row_tipo['tipo']); ?></option>
      <?php } while ($row_tipo = mysql_fetch_assoc($tipo)); mysql_free_result($tipo); ?>
    </select><br /><br />
  <input type="submit" name="guardar" value="Guardar" />
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="destino" value="<?= $destino_received ?>" />
  </fieldset>
</form>
</div>
<?php 
 if($totalRows_menu > 0) {
?>
<br/><br/>
<p><strong>Listado de paginas</strong></p><br />
  <ul id="listar">
     <?php 
      do { 
      ?>
    <li><a href="editar_pagina.php?action=<?php echo $row_menu['id_pag']; ?>" <?php if($row_menu['estado']== "0"){ echo 'class = rojo';}?>><?php echo $row_menu['titulo']; ?><?php if($row_menu['estado']!= "0"){ echo '( Activo )';} else { echo '( Inactivo )';} ?></a></li>
    <?php 
        } while ($row_menu = mysql_fetch_assoc($menu)); 
        mysql_free_result($menu);
    ?>
  </ul>
<br /><br />
<?php } ?>
</section>
<script>
  const activoDestination = '<?= $destino_received ?>';
  sessionStorage.setItem('active', activoDestination);
</script>
<script src="js/destino.js"></script>
</body>
</html>