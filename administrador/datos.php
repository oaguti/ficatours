<?php 
/*incluimos el header*/
include('header.php');

/*Acciones para subir datos de fformulario*/
$editFormAction = $_SERVER['PHP_SELF'];

/*if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}*/

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
    $keys_post = array_keys($_POST); 
    foreach ($keys_post as $key_post) 
     { 
      $$key_post = $_POST[$key_post]; 
      error_log("variable $key_post viene desde $ _POST"); 
     }
    $insertSQL = "UPDATE empresa SET direccion = '".$direccion."', 
                                    telefono = '".$telefono."',
                                    Fax = '".$fax."', 
                                    emergencia = '".$emergencia."',
                                    email = '".$correo1."',
                                    email2 = '".$correo2."', 
                                    facebook = '".$facebook."', 
                                    twitter = '".$twitter."'";
    mysql_select_db($database_demo, $demo);
	$Result1 = mysql_query($insertSQL, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("DATOS GUARDADOS");</script>';
}
mysql_select_db($database_demo, $demo);
mysql_query("SET NAMES 'utf8'");
$query_empresa = "SELECT * FROM empresa WHERE id_empresa = '1'";
$empresa = mysql_query($query_empresa, $demo) or die(mysql_error());
$row_empresa = mysql_fetch_assoc($empresa);
$totalRows_empresa = mysql_num_rows($empresa);
?>
<section>
<h1>Ingrese los datos de la empresa</h1><br/>

<br/>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="agregar">
  <label>Direcci&oacute;n</label><br /><br />
  <input type="text" name="direccion" class="cuatro" value="<?php echo $row_empresa['direccion']; ?>" /><br /><br />
  <label>Tel&eacute;fono</label><br /><br />
  <input type="text" name="telefono" id="telefono" value="<?php echo $row_empresa['telefono']; ?>" /><br /><br />
  <label>Fax</label><br /><br />
  <input type="text" name="fax" id="fax" value="<?php echo $row_empresa['fax']; ?>" /><br /><br />
  <label>Telefono de emergencia</label><br /><br />
  <input type="text" name="emergencia" id="emergencia" value="<?php echo $row_empresa['emergencia']; ?>" /><br /><br />
  <label>E-mail 1</label><br /><br />
  <input type="text" name="correo1" id="email1" value="<?php echo $row_empresa['email']; ?>" /><br /><br />
  <label>E-mail 2</label><br /><br />
  <input type="text" name="correo2" id="email2" value="<?php echo $row_empresa['email2']; ?>" /><br /><br />
  <label>Facebook</label><br /><br />
  <input type="text" name="facebook" class="cuatro" value="<?php echo $row_empresa['facebook']; ?>" /><br /><br />
  <label>Twitter</label><br /><br />
  <input type="text" name="twitter" class="cuatro" value="<?php echo $row_empresa['twitter']; ?>" /><br /><br />
  <input type="submit" value="Guardar" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<br /><br />
</section>
</body>
</html>