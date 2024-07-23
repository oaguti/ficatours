<?php 
/*incluimos el header*/
include('header.php');
/////////////////////////////////////////
mysql_select_db($database_demo, $demo);
$query_menu = "SELECT * FROM paginas WHERE tipo = 2 AND estado = 1 ORDER BY id_pag ASC";
$menu = mysql_query($query_menu, $demo) or die(mysql_error());
$row_menu = mysql_fetch_assoc($menu);
$totalRows_menu = mysql_num_rows($menu);
?>
<script type="text/javascript">
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
xmlhttp.open("GET","editar_lista.php?q="+str,true);
xmlhttp.send();
}
</script>
<section>
<h1>Lista de secciones de la Pagina</h1><br/>
<div style="width: 300px; overflow: hidden;">
<form id="agregar" style="margin-bottom: 20px; overflow: hidden;">
<label>Seleccione la pagina:</label>&nbsp;&nbsp;
  <select name="paginas" onchange="mostrar_lista(this.value)">
    <option value="">Seleccione una pagina:</option>
     <?php do { ?>
    <option value="<?php echo $row_menu['id_pag']; ?>" ><?php echo $row_menu['titulo']; ?></option>
    <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
    mysql_free_result($menu);
    ?>
  </select>
</form>
<div id="txtHint"></div>
<br />
</div>
<br/>
</section>
</body>
</html>