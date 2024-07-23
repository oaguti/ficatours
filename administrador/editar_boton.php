<?php
$valor = $_GET['action'];
/*incluimos el header*/
include('header.php');
//////////////////////////////////////////
$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $url = $_POST['url'];
    $titulo = $_POST['titulo'];
    $id = $_POST['id'];
    
    $insertSQL = "UPDATE online SET titulo = '".$titulo."',url='".$url."' WHERE id = '".$id."' "; 
    mysql_select_db($database_demo, $demo);
	mysql_query($insertSQL, $demo) or die(mysql_error());
    mysql_close($demo);
    echo '<script type="text/javascript">alert("boton actualizado");location.href="agregar_boton.php";</script>';
    }
    
/////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT id,titulo,url FROM online WHERE id = ".$valor." ORDER BY id ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
mysql_close($demo);
?>
<section>
<h1>Paginas del sitio web</h1><br/>
<div style="width: 100%; overflow: hidden;" >
<p><strong>Agregar pagina</strong></p><br />
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="agregar">
<fieldset>
<label>Titulo de boton:</label><br /><br />
<input type="text" name="titulo" class="url" value="<?php echo $row_menu['titulo']; ?>"/><br /><br />
<label>Escriba la url del boton:</label><br/><br/>
<input type="text" name="url" class="url" value="<?php echo $row_menu['url']; ?>" /><br /><br />

<input type="submit" name="guardar" value="Actualizar" />
<input type="hidden" name="MM_insert" value="form1" />
<input type="hidden" name="id" value="<?php echo $valor; ?> " />
</fieldset>
</form>
</div>

</section>
</body>
</html>