<?php 
/*incluimos el header*/
include('header.php');
//////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT * FROM paginas WHERE tipo = 2  ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
?>
<script type="text/javascript">

function mostrar_lista(str)
{
    if (str=="")
      {
      document.getElementById("txtsection").innerHTML="";
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
        document.getElementById("txtsection").innerHTML=xmlhttp.responseText;
        }
      }
xmlhttp.open("GET","mostrar_lista_c.php?q="+str,true);
xmlhttp.send();
}
function mostrar_conte(str)
{
    if (str=="")
      {
      document.getElementById("txtdet").innerHTML="";
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
        document.getElementById("txtdet").innerHTML=xmlhttp.responseText;
        }
      }
xmlhttp.open("GET","lista_detalle_eliminar.php?q="+str,true);
xmlhttp.send();
}
</script>
<section>
<h1>Agregar contenido a paginas tipo lista</h1><br/>

<p><strong>Editar contenido de seci&oacute;n</strong></p><br />
<form id="consulta">
<fieldset>
<div class="linea">
<label>Seleccione la pagina:</label>
  <select name="paginas" onchange="mostrar_lista(this.value)">&nbsp;&nbsp;
    <option value="">Seleccione una pagina:</option>
     <?php do { ?>
    <option value="<?php echo $row_menu['id_pag']; ?>" ><?php echo $row_menu['titulo']; ?></option>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    ?>
  </select>
</div>
<div id="txtsection"></div>
</fieldset>
</form><br/><br/>
<div id="txtdet"></div>

</section>
</body>
</html>