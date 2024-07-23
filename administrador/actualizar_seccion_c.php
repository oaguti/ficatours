<?php 
/*incluimos el header*/
include('header.php');
$id = $_GET['action'];
/*funcion para validad los datos a subir*/
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

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
   ////////////// Parte añadida 1 ////////////// 
  $titulo = $_POST['titulo'];
  $detalle = $_POST['detalle'];
  $insertSQL = sprintf("INSERT INTO textos(titulo, texto) VALUES (%s, %s)",
						   GetSQLValueString(htmlentities($titulo), "text"),
                           GetSQLValueString($detalle, "text"));
                           
    
    mysql_select_db($database_demo, $demo);
	$Result1 = mysql_query($insertSQL, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("DATOS GUARDADOS"); </script>';
}
mysql_select_db($database_demo, $demo);
$query_texto = "SELECT * FROM textos WHERE id_pag = '".$id."'";
$texto = mysql_query($query_texto, $demo) or die(mysql_error());
$row_texto = mysql_fetch_assoc($texto);
$totalRows_texto = mysql_num_rows($texto);
?>
<script type="text/javascript">
function aparecer(){$('#fondo').fadeIn(600);}
function cerrar() {
    $('#fondo').fadeOut(1000);
    $("#txtResultado").html("");
    clearFileInputField('upload');
    }
function clearFileInputField(tagId) {
    document.getElementById(tagId).innerHTML =
        document.getElementById(tagId).innerHTML;
    }
function enviar(){
	var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
    var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
    var data = new FormData();
    
    for(i=0; i<archivo.length; i++){
    data.append('archivo'+i,archivo[i]);
    }
    
    $.ajax({
           data:  data,
           url:   'upload_img.php',
           type:  'post',
           contentType:false,
           processData:false,
           cache:false,
           beforeSend: function () {
           $("#msj").html("Subiendo imagen...");
           },
           success:  function (response) 
           {
            $("#msj").html("");
            $("#txtResultado").html(response);
            }
    });
}
</script>
<div id="fondo">
	<div id="upload">
    <h2>Subir imagen</h2><br />
    <br />
    <form action="" method="post" name="formOperaciones">
     <label>Ubicar la imagen a subir:</label><br /><br />
    <input id="archivos" type="file" name="archivos[]" multiple="multiple"/><br /><br />
    <input type="submit" value="Subir imagen" onClick ="enviar(); return false;" />
    </form>
    <br />
    <span id="msj"></span><br />
    <p><strong>Ruta de Imagen, seleccionar y copiar:</strong></p>
    <div id="txtbox"><span id="txtResultado"></span></div><br /><br />
    <a href="javascript:cerrar();" style="text-decoration: none; color: #da251c;">Cerrar</a>
    </div>
</div>
<section>
<h1>Ingrese el contenido de la seccion</h1><br/>

<br/>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="agregar">
  <label>Titulo de secci&oacute;n</label><br /><br />
  <input type="text" name="titulo" id="titulo" value="<?php echo $row_texto['titulo'] ?>"/><br /><br />
  <label>Contenido de la secci&oacute;n</label><br /><br />
  <textarea class="ckeditor" cols="150" id="editor1" name="detalle" rows="10">
	<?php echo $row_texto['texto'] ?>		
  </textarea>
  <br /><br />
  <input type="submit" value="Guardar" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<div style="float: right; width: 180px;">
<p>Para insertar imagenes al editor de texto primero tiene que subirla al servidor, el sistema le dara una <strong>ruta</strong> la cual tiene que <strong>copiar</strong>.</p><br />
<a href="javascript:aparecer();">Subir Imagen</a>
</div>
<br /><br />
</section>
</body>
</html>