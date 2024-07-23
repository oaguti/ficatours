<?php 
    include("include/header.php");
    $id = obtenerId('destino');
    $sql = "SELECT id_pag,titulo,tipo FROM paginas WHERE id_destino = $id AND estado = 1";
    $categorias = consultaDB($sql);
    if(count($categorias) > 0){
        $categoria = obtenerId('categoria',$categorias[0]['id_pag']);
    }
    else {
        $categoria = obtenerId('categoria');
    }
    $textoDestino = searchData($destinos,$id,['buscar'=>'id','valor'=>'destino']);
    $textoCategoria = searchData($categorias,$categoria,['buscar'=>'id_pag','valor'=>'titulo']);
    $query_lista = "SELECT archivo,titulo,id_section FROM secciones WHERE id_pag = ".$categoria." AND estado = 1 ORDER BY id_pag ASC";
    $secciones = consultaDB($query_lista);
?>
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase"><?= $textoDestino ?></h3>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white mb-3" style="padding: 30px;">
                        <h2 class="mb-3"><?=$textoCategoria?></h2>
                        <?php 
                            listCategoria($secciones)
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <!-- Category List -->
                    <div class="mb-5">
                        <!-- <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Categories</h4> -->
                        <div class="bg-white" style="padding: 30px;">
                            <ul class="list-inline m-0">
                                <?php 
                                    
                                    $template = '<li class="mb-3 d-flex justify-content-between align-items-center">
                                        <a class="text-dark" href="destino.php?destino='.$id.'&categoria={id_pag}"><i class="fa fa-angle-right text-primary mr-2"></i>{titulo}</a>
                                    </li>';
                                    $indices = array('id_pag','titulo');
                                    listarArray($categorias,$template,$indices);
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php 
    include("include/footer.php");
?>