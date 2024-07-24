<?php  
if(isset($_GET['destino'])){
    $destino_received = $_GET['destino'];
} else {
    $destino_received = $_SESSION['destino'];
}
?>