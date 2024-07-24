<?php 
    /*incluimos el header*/
    include('header.php');
    //////////////////////////////////////////
    mysql_select_db($database_demo, $demo);
    $query_menu = "SELECT id,destino FROM destinos WHERE estado = 1 ORDER BY id ASC";
    $menu = mysql_query($query_menu, $demo) or die(mysql_error());
    $row_menu = mysql_fetch_assoc($menu);
    $totalRows_menu = mysql_num_rows($menu);
    /////////////////////////////////////////
    mysql_close($demo);
    
?>
<section>
    <h1>Seleccionar un destino</h1><br/>
    <div class="card_container">
        <?php 
            $list_destinos = array();
            do { 
                echo '<a href="listar_paginas.php?destino='.$row_menu['id'].'" class="card_item">'.$row_menu['destino'].'</a>';
                array_push($list_destinos,array("id"=>$row_menu['id'],"destino"=>$row_menu['destino']));
            } while ($row_menu = mysql_fetch_assoc($menu)); 
            $JSONDestinos = json_encode($list_destinos);
        ?>
    </div>
</section>
<script>
    const menu = document.getElementById('menu');
    const destinos = JSON.parse('<?php echo $JSONDestinos ?>');
    const jsonString = JSON.stringify(destinos);

    menu.style.display = 'none';
    sessionStorage.setItem('destinos', jsonString);
</script>
</body>
</html>