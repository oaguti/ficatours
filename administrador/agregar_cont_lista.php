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
    if(isset($_POST['archivo'])){
        $archivo = $_POST['archivo'];  
    }
    $seccion = $_POST['seccion'];
    $titulo = $_POST['titulo'];
    $estado = "1";
    echo $seccion.','.$titulo.','.$estado;
    if(isset($archivo)){
        $insertSQL = sprintf("INSERT INTO detalle (id_seccion,titulo,archivo,estado) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($seccion, "text"),
                           GetSQLValueString(htmlentities($titulo), "text"),
                           GetSQLValueString($archivo, "text"),
                           GetSQLValueString($estado, "text")); 
    } else {
        $insertSQL = sprintf("INSERT INTO detalle (id_seccion,titulo, estado) VALUES (%s, %s, %s)",
						   GetSQLValueString($seccion, "text"),
                           GetSQLValueString(htmlentities($titulo), "text"),
                           GetSQLValueString($estado, "text"));     
    }
    mysql_select_db($database_demo, $demo);
	$Result1 = mysql_query($insertSQL, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("CONTENIDO DE SECCION GUARDADA");</script>';
    } 
    
/////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT * FROM paginas WHERE tipo = '2'  ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
?>
<script type="text/javascript">
function aparecer(){$('#fondo').fadeIn(600);}
function cerrar() {
    $('#fondo').fadeOut(1000);
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
           url:   'upload_archivo.php',
           type:  'post',
           contentType:false,
           processData:false,
           cache:false,
           beforeSend: function () {
           $("#msj").html("Subiendo archivo...");
           },
           success:  function (response) 
           {
            $("#msj").html(response);
            $("#archivo").val(response);
            }
    });
}
function mostrar_lista(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","mostrar_lista.php?q="+str,true);
xmlhttp.send();
}
</script>
<div id="fondo">
	<div id="upload">
    <h2>Subir Archivos</h2><br />
    <br />
    <form action="" method="post" name="formOperaciones">
     <label>Ubicar el archivo a subir:</label><br /><br />
    <input id="archivos" type="file" name="archivos[]" multiple="multiple"/><br /><br />
    <input type="submit" value="Subir archivo" onClick ="enviar(); return false;" />
    </form>
    <br />
    <span id="msj"></span><br /><br />
    <a href="javascript:cerrar();" style="text-decoration: none; color: #da251c;">Cerrar</a>
    </div>
</div>
<section>
<h1>Agregar contenido a paginas tipo lista</h1><br/>
<div style="width: 100%; overflow: hidden;">
<p><strong>Agregar lista</strong></p><br />
<form id="agregar">
<label>Seleccione la pagina:</label>&nbsp;&nbsp;
  <select name="paginas" onchange="mostrar_lista(this.value)">
    <option value="">Seleccione una pagina:</option>
     <?php do { ?>
    <option value="<?php echo $row_menu['id_pag']; ?>" ><?php echo $row_menu['titulo']; ?></option>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    ?>
  </select><br /><br />
</form>

<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="agregar">
<fieldset>
<label>Seleccione la secci&oacute;n:</label><br /><br />
<div id="txtHint"></div>
<br />
<label>Titulo de detalle:</label><br/><br/>
<input type="text" name="titulo" id="titulo" class="cuatro" /><br /><br />
<label>Adjuntar archivo:</label><br />
<input type="text" name="archivo" id="archivo" readonly="readonly" />&nbsp;&nbsp;<a href="javascript:aparecer();">Subir Archivo</a><br /><br />
<input type="submit" name="guardar" value="Guardar" />
<input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
</div>
<br/><br/>
</section>
</body>
</html>