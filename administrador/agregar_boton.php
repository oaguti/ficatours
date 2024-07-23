<?php 
/*incluimos el header*/
include('header.php');
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
    $url = $_POST['url'];
    $titulo = $_POST['titulo'];
    $estado = 1;
    
    $insertSQL = sprintf("INSERT INTO online (titulo,url,estado) VALUES (%s, %s, %s)",
						   GetSQLValueString(htmlentities($titulo), "text"),
                           GetSQLValueString($url, "text"),
                           GetSQLValueString($estado, "int")); 
    mysql_select_db($database_demo, $demo);
	mysql_query($insertSQL, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("boton creado");</script>';
    }
    
/////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT id,titulo,url FROM online WHERE estado = 1 ORDER BY id ASC";
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
<input type="text" name="titulo" class="url"/><br /><br />
<label>Escriba la url del boton:</label><br/><br/>
<input type="text" name="url" class="url"/><br /><br />

<input type="submit" name="guardar" value="Guardar" />
<input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
</div>
<br/><br/>
<?php 
     if(isset($row_menu)){
      
echo '<p><strong>Listado de paginas</strong><br /><br />En esta secci&oacute;n apareceran la lista de pagina y si tiene un boton creado para editar el boton dar clic sobre la pagina</p><br />
  <ul id="listar">';
     do { ?>
    <li><a href="editar_boton.php?action=<?php echo $row_menu['id']; ?>"><?php echo $row_menu['titulo']; ?></a></li>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    }
    ?>
  </ul>
<br /><br />
</section>
</body>
</html>