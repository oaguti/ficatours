<?php 
/*incluimos el header*/
include('header.php');
if(isset($_GET['id'])){
    $pagina = $_GET['id'];
}
$editFormAction = $_SERVER['PHP_SELF'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $archivo = $_POST['archivo'];
    //echo $archivo;
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    if($archivo != ""){
    $query_Recordset1 = "UPDATE detalle SET titulo = '". $titulo."', archivo = '".$archivo."' WHERE id = ".$id; 
    } else {
    $query_Recordset1 = "UPDATE detalle SET titulo = '".$titulo."'  WHERE id =".$id;
    
    } 
    mysql_select_db($database_demo, $demo);
	$resultado = mysql_query($query_Recordset1, $demo) or die(mysql_error());
    echo '<script type="text/javascript">alert("SECCION GUARDADA");</script>';
} 
 
if(isset($pagina)){
mysql_select_db($database_demo, $demo);    
$query_lista = "SELECT id,titulo,archivo FROM detalle WHERE id = '".$pagina."'";
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
    <input type="submit" value="Subir archivo" onClick ="enviar(); return false;" />
    </form>
    <br />
    <span id="msj"></span><br /><br />
    <a href="javascript:cerrar();" style="text-decoration: none; color: #da251c;">Cerrar</a>
    </div>
</div>
<section>
<h1>Actualizar detalle a la seccion</h1><br/>
<div style="width: 100%; overflow: hidden;">
<p><strong>Actualizar contenido de secci&oacute;n</strong></p><br />
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="agregar">
<fieldset>
<label>Titulo de la contenido:</label><br/><br/>
<input type="text" name="titulo" id="titulo" class="cuatro" value="<?php echo $row_lista['titulo']  ?>" /><br /><br />
<label>Adjuntar archivo:</label><br />
<input type="text" name="archivo" id="archivo" value="<?php if($row_lista['archivo'] != ""){ echo $row_lista['archivo']; } ?>" readonly="readonly" />&nbsp;&nbsp;<a href="javascript:aparecer();">Subir Archivo</a><br /><br />
<input type="submit" name="guardar" value="Guardar" />&nbsp;&nbsp;<input type="reset" name="Borrar" value="Borrar" />
<input type="hidden" name="id" value="<?php echo $row_lista['id']; ?>" />
<input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
</div>
<br/><br />
</section>
</body>
</html>