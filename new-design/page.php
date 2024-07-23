<?php 
    include("include/header.php");
    if(isset($_GET['id'])){
        $id_pag = $_GET['id'];
        $query_page = "SELECT titulo, texto FROM textos WHERE id_pag = $id_pag AND estado = 1";
        $dataPag = consultaDB($query_page);
        $titulo = $dataPag[0]['titulo'];
    }
?>
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase"><?=strtoupper($titulo)?></h3>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"><?=$titulo?></h6>
                        <?=$dataPag[0]['texto']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php 
    include("include/footer.php");
?>