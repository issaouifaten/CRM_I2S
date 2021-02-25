<?php
require "../../Connexion/db.php";
$CodeAppel=$_GET['CodeAppel'];

$sql="update AppelDemandeCRM set NumeroEtat='E40' where NumeroAppel='$CodeAppel'";
$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$Observation));
$test=1;

if (!$stmt) {
    echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}


if (sqlsrv_execute($stmt) === false) {
    //  echo 'type <br>';
    echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}

sqlsrv_free_stmt($stmt);
echo $test;