<?php 
    /*incluimos el header*/
    include('header.php');
    //////////////////////////////////////////
    mysql_select_db($database_demo, $demo);
    $query_menu = "SELECT id,destino FROM destinos WHERE estado = 1 ORDER BY id_pag ASC";
    $menu = mysql_query($query_menu, $demo) or die(mysql_error());
    $row_menu = mysql_fetch_assoc($menu);
    $totalRows_menu = mysql_num_rows($menu);
    /////////////////////////////////////////
    mysql_close($demo);
?>
<section>
    <h1>Paginas del sitio web</h1><br/>
    <div style="width: 100%; overflow: hidden;" >
    <p><strong>Seleccionar un destino</strong></p><br />
    </div>
    <p><strong>Destinos</strong></p><br />
    <ul id="listar">
        <?php do { ?>
        <li><a href="listar_paginas.php?action=<?php echo $row_menu['id_pag']; ?>" <?php if($row_menu['estado']== "0"){ echo 'class = rojo';}?>><?php echo $row_menu['titulo']; ?><?php if($row_menu['estado']!= "0"){ echo '( Activo )';} else { echo '( Inactivo )';} ?></a></li>
        <?php } while ($row_menu = mysql_fetch_assoc($menu)); 
        mysql_free_result($menu);
        ?>
    </ul>
    <br /><br />
</section>
</body>
</html>