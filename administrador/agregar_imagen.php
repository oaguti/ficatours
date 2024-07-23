<?php 
/*incluimos el header*/
include('header.php');
//////////////////////////////////////////
$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    if($_POST['archivo']!=""){
        $archivo = $_POST['archivo'];
        $pagina = $_POST['pagina'];
        $estado = "1";
        $insertSQL = "INSERT INTO galeria (id_pag,img,estado) VALUES ('".$pagina."','".$archivo."','".$estado."')";
	    mysql_select_db($database_demo, $demo);
	    $Result1 = mysql_query($insertSQL, $demo) or die(mysql_error());
        echo '<script type="text/javascript">alert("IMAGEN GUARDADA");</script>';  
    } else 
     echo '<script type="text/javascript">alert("NO HAY IMAGEN SUBIDA");</script>';
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
           url:   'upload_imagen.php',
           type:  'post',
           contentType:false,
           processData:false,
           cache:false,
           beforeSend: function () {
           $("#msj").html("Subiendo imagen...");
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
    <input type="submit" value="Subir imagen" onClick ="enviar(); return false;" />
    </form>
    <br />
    <span id="msj"></span><br /><br />
    <a href="javascript:cerrar();" style="text-decoration: none; color: #da251c;">Cerrar</a>
    </div>
</div>
<section>
<h1>Agregar imagen a la pagina tipo lista</h1><br/>
<div style="width: 100%; overflow: hidden;">
<p><strong>Agregar imagen</strong></p><br />
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="agregar" enctype="multipart/form-data">
<fieldset>
<label>Seleccione la pagina:</label>&nbsp;&nbsp;
  <select name="pagina" id="pagina" >
    <?php do { ?>
    <option value="<?php echo $row_menu['id_pag']; ?>" ><?php echo $row_menu['titulo']; ?></option>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    ?>
  </select><br /><br /><br />
<label>Nombre de imagen:</label><br /><br />
<input type="text" name="archivo" readonly="readonly" id="archivo" />&nbsp;&nbsp;<a href="javascript:aparecer();">Subir Imagen</a><br /><br />
<input type="submit" name="guardar" value="Guardar" />
<input type="hidden" name="MM_insert" value="form1" />
</fieldset>
</form>
</div>
<br/><br/>
</section>
</body>
</html>