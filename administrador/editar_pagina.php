<?php 
/*incluimos el header*/
include('header.php');
$id = $_GET['action'];
mysql_select_db($database_demo, $demo);
$query_pagina = "SELECT * FROM paginas WHERE id_pag = '".$id."'";
$pagina = mysql_query($query_pagina, $demo) or die(mysql_error());
$row_pagina = mysql_fetch_assoc($pagina);
$totalRows_pagina = mysql_num_rows($pagina);
$valor = $row_pagina['tipo'];
/////////////////////////////////////////
$query_tipo = "SELECT * FROM tipos WHERE estado = '1' ORDER BY id_tipo ASC";
$tipo = mysql_query($query_tipo, $demo) or die(mysql_error());
$row_tipo = mysql_fetch_assoc($tipo);
$totalRows_tipo = mysql_num_rows($tipo);
?>
<section>
<h1>Paginas del sitio web</h1><br/>
<div style="width: 100%; overflow: hidden;">
<p><strong>Editar pagina</strong></p><br />
<form action="actualizar_pagina.php" method="POST" name="form1" id="agregar">
<fieldset>
<label>Escriba el nombre de la pagina:</label><br/>
<input type="text" name="titulo" id="nombre" value="<?php echo $row_pagina['titulo'] ?>" /><br /><br />
<label>Tipo de pagina:</label>
<select name="tipo">
     <?php do { ?>
    <option value="<?php echo $row_tipo['id_tipo']; ?>" <?php if($valor == $row_tipo['id_tipo']){echo "selected";} ?> ><?php echo $row_tipo['tipo']; ?></option>
    <?php } while ($row_tipo = mysql_fetch_assoc($tipo)); mysql_free_result($tipo); ?>
  </select><br /><br />
<label>Estado:</label><br /><br />
  <select name="estado">
    <option value="1" <?php if($row_pagina['estado'] == "1"){echo "selected";} ?>>Activo</option>
    <option value="0" <?php if($row_pagina['estado'] == "0"){echo "selected";} ?>>Inactivo</option>
  </select><br /><br />
<input type="submit" name="guardar" value="Guardar" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
</div>
<br/><br/>
<?php mysql_free_result($pagina); ?>
</section>
</body>
</html>