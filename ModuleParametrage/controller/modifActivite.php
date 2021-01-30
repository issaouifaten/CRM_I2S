<?php

require "../../Connexion/db.php";
$Nom=$_GET['Nom'];
$Code=$_GET['Code'];
$Type=$_GET['Type'];

$sql =  "update  Activite set LibelleActivite=?,TypeActivite=? where CodeActivite=?  ";

$stmt = sqlsrv_prepare($conn, $sql, array(&$Nom,&$Type,&$Code));
$test=1;
if (!$stmt) {
     // echo '!sql <br>';
    //die(print_r(sqlsrv_errors(), true));
    $test=0;
}


if (sqlsrv_execute($stmt) === false) {
      //  echo 'type <br>';
     // die(print_r(sqlsrv_errors(), true));
    $test=0;
}

sqlsrv_free_stmt($stmt);
echo $test;