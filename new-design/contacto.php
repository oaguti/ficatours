<?php 
    include("include/header.php");
?>
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">CONTACTENOS</h3>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Contactenos</h6>
                <h1>Contacto para cualquier consulta</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form bg-white" style="padding: 30px;">
                        <?php 
                            if(isset($_GET['envio'])){
                                $data = array('ok'=>'Mensaje enviado con exito!','error'=>'Hubo un error, vuelva a intentar');
                                $txt = $_GET['envio'] == 'ok' ? $data['ok'] : $data['error'];
                                $msg = '<div id="success" class="alert alert-success" role="alert">'.$txt.'</div>';
                                echo $msg;
                            }
                        ?>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST" action="procesar-mail.php">
                            <div class="form-row">
                                <div class="control-group col-sm-6">
                                    <input type="text" class="form-control p-4" name="nombre" id="nombre" placeholder="Nombre"
                                        required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group col-sm-6">
                                    <input type="email" class="form-control p-4" name="email" id="email" placeholder="Correo"
                                        required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control p-4" name="empresa" id="empresa" placeholder="Empresa"
                                    required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control py-3 px-4" rows="5" name="mensaje" id="mensaje" placeholder="Mensaje"
                                    required="required"
                                    data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php 
    include("include/footer.php");
?>