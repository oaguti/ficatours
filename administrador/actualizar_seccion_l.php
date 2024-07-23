<?php 
/*incluimos el header*/
include('header.php');
$pagina = $_GET['id'];

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    if(isset($_POST['archivo'])){
      $archivo = $_POST['archivo'];  
    }
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    //echo 'Valor de la pagina= '.$pagina;
    if(isset($archivo)){
    $query_Recordset1 = "UPDATE secciones SET titulo = '" . htmlentities($titulo) . "', archivo = '".$archivo."'  WHERE id_section = '".$id."'"; 
    
    } else {
    $query_Recordset1 = "UPDATE secciones SET titulo = '" . htmlentities($titulo) . "'  WHERE id_section = '".$id."'";
    
    }
    mysql_select_db($database_demo, $demo);
	$resultado = mysql_query($query_Recordset1, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("SECCION GUARDADA"); location.href="listar_seccion_l.php";</script>';
} 
    
/*////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT * FROM paginas WHERE tipo = '2'  ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);*/
///////////////////////////////////////
if(isset($pagina)){
mysql_select_db($database_demo, $demo);     
$query_lista = "SELECT id_section,titulo,archivo FROM secciones WHERE id_section = '".$pagina."'";
$lista = mysql_query($query_lista, $demo) or die(mysql_error());
$row_lista = mysql_fetch_assoc($lista);
$totalRows_lista = mysql_num_rows($lista);
}
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
</script>
<div id="fondo">
	<div id="upload">
    <h2>Subir Archivos</h2><br />
    <br />
    <form action="" method="post" name="formOperaciones">
     <label>Ubicar el archivo a subir:</label><br /><br />
    <input id="archivos" type="file" name="archivos[]" multiple="multiple"/><br /><br />
    <input type="submit" value="Subir >>" onClick ="enviar(); return false;" />
    </form>
    <br />
    <span id="msj"></span><br /><br />
    <a href="javascript:cerrar();" style="text-decoration: none; color: #da251c;">Cerrar</a>
    </div>
</div>
<section>
<h1>Editar seccion</h1><br/>
<div style="width: 100%; overflow: hidden;">
<p><strong>En este seccion puede modificar el titulo de la seccion y reemplazar el archivo adjunto.</strong></p><br />
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="agregar">
<fieldset>
<label>Titulo de la secci&oacute;n:</label><br/><br/>
<input type="text" name="titulo" id="titulo" class="cuatro" value="<?php echo $row_lista['titulo']  ?>" /><br /><br />
<label>Adjuntar archivo:</label><br />
<input type="text" name="archivo" id="archivo" value="<?php if($row_lista['archivo'] != ""){ echo $row_lista['archivo']; } ?>" readonly="readonly" />&nbsp;&nbsp;<a href="javascript:aparecer();">Subir Archivo</a><br /><br />
<input type="submit" name="guardar" value="Actualizar" />
<input type="hidden" name="id" value="<?php echo $row_lista['id_section']; ?> " />
<input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
</div>
<br/><br />
</section>
</body>
</html>