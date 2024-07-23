<?php 
/*incluimos el header*/
include('header.php');
//////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT * FROM paginas WHERE tipo = '2'  ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
?>
<script type="text/javascript">
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
xmlhttp.open("GET","listar_imagenes.php?q="+str,true);
xmlhttp.send();
}
</script>
<section>
<h1>Eliminar imagen de pagina</h1><br/>

<form id="consulta">
<fieldset>
<div class="linea">
<label>Seleccione la pagina:</label>
  <select name="paginas" onchange="mostrar_conte(this.value)">&nbsp;&nbsp;
    <option value="">Seleccione una pagina:</option>
     <?php do { ?>
    <option value="<?php echo $row_menu['id_pag']; ?>" ><?php echo $row_menu['titulo']; ?></option>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    ?>
  </select>
</div>
</fieldset>
</form><br/><br/>
<div id="txtdet"></div>

</section>
</body>
</html>