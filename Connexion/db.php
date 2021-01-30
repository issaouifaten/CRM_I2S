
<?php


$serverName = "192.168.1.24"; //serverName\instanceName
$connectionInfo = array( "Database"=>"I2S_erp", "UID"=>"sa", "PWD"=>"ideal2s");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
 /*     echo "Connexion établie.<br />"; */
}else{
     echo "La connexion n'a pu être établie.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>
