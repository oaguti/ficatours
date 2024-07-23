<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//DESARROLLO
$hostname_demo = "localhost";
$database_demo = "ficatour_ficatours";
$username_demo = "root";
$password_demo = "";
//PRODUCCION
// $hostname_demo = "localhost";
// $database_demo = "ficatour_ficatours";
// $username_demo = "ficatour_user";
// $password_demo = "turismo$2013";
$demo = mysql_pconnect($hostname_demo, $username_demo, $password_demo) or trigger_error(mysql_error(),E_USER_ERROR); 
?>