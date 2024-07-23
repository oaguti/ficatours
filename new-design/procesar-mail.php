<?php
header('Content-Type: text/html; charset=UTF-8');
	
$keys_post = array_keys($_POST); 
foreach ($keys_post as $key_post){ 
  $$key_post = $_POST[$key_post]; 
  error_log("variable $key_post viene desde $ _POST"); 
}

$dest = 'webmaster@ficatours.com'; 
$html = "
	<h2 style='font:bold 16px Arial'>Contáctenos - Pagina Web</h2>
<p style='font:normal 12px Arial'>Los siguientes datos fueron enviados:<p>
<table border='0' cellpadding='0' cellspacing='0' style='font:normal 12px Arial'>
<tr>
  <td width='160' align='left' valign='top'></td>
<td width='287' align='left' valign='top'></td>
</tr>
<tr>
  <td align='left' valign='top'><strong>Nombre :</strong></td>
<td align='left' valign='top'>".$nombre."</td>
</tr>
<tr>
  <td align='left' valign='top'><strong>Empresa :</strong></td>
<td align='left' valign='top'>".$empresa."</td>
</tr>
<tr>
  <td align='left' valign='top'><strong>Móvil:</strong></td>
  <td align='left' valign='top'>".$email."</td>
</tr>
<tr>
  <td align='left' valign='top'><strong>Asunto :</strong></td>
  <td align='left' valign='top'>".$mensaje."</td>
</tr>
</table>";
	
$cabeceras  = 'MIME-Version: 1.0'."\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8'."\r\n";
$cabeceras .= 'From:'.$email."\r\n";
$envio = mail($dest,"FICATOURS - Nuevo Contacto",$html,$cabeceras);
if($envio){
  header("Location: contacto.php?envio=ok");
} else {
  header("Location: contacto.php?envio=error");
}
?>