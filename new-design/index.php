<?php 
    include("include/header.php");
?>
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $indice_carrusel = ['titulo','subtitule','image','clase'];
                $array_carrusel = [
                    ['titulo'=>'Excursiones y viajes','subtitule'=>'La experiencia hace la diferencia','image'=>'s1.jpg','clase'=>'active'],
                    ['titulo'=>'Excursiones y viajes','subtitule'=>'Descubre lugares increíbles con nosotros','image'=>'s4.jpg','clase'=>''],
                    ['titulo'=>'Excursiones y viajes','subtitule'=>'Descubramos el mundo juntos','image'=>'s5.jpg','clase'=>'']
                ];
                $template_carrusel ='<div class="carousel-item {clase}">
                    <img class="w-100" src="img/slider/{image}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">{titulo}</h4>
                            <h1 class="display-3 text-white mb-md-4">{subtitule}</h1>
                            
                        </div>
                    </div>
                </div>';
                listarArray($array_carrusel,$template_carrusel,$indice_carrusel)
                ?>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destinos</h6>
                <h1>Explora nuevos destinos</h1>
            </div>
            <div class="row">
                <?php
                    $i = 1;
                    foreach ($destinos as $key => $value) {
                        echo '<div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                                <img class="img-fluid" src="img/destination-'.strval($i).'.jpg" alt="">
                                <a class="destination-overlay text-white text-decoration-none" href="destino.php?destino='.$value['id'].'">
                                    <h5 class="text-white">'.$value['destino'].'</h5>
                                </a>
                            </div>
                        </div>';
                        $i++ ; 
                    };
                ?>
            </div>
        </div>
    </div>
    <!-- Destination Start -->
    <script>
        const dataEmpresa = <?php echo json_encode($empresa); ?>;
        if(!sessionStorage.dataEmpresa){
            sessionStorage.setItem('dataEmpresa', JSON.stringify(dataEmpresa));
        }
    </script>
<?php 
    include("include/footer.php");
?>