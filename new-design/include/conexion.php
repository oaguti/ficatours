<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
function connect(){
    //DESARROLLO
    $host = "localhost";
    $db = "ficatour_ficatours";
    $user = "root";
    $pwd = "";

    //PRODUCCION
   /*  $host = "localhost";
    $db = "ficatour_ficatours";
    $user = "ficatour_user";
    $pwd = "turismo$2013"; */
    
    try {
        $conn = new \PDO( "mysql:host=$host;dbname=$db", $user, $pwd, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'',\PDO::MYSQL_ATTR_LOCAL_INFILE=>1));
        $conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e) {
        echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
        die();
    }
    return $conn;
}
?>