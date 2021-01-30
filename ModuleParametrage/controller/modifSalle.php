<?php

require "../../Connexion/db.php";
$Nom=$_GET['Nom'];
$Code=$_GET['Code'];


$sql =  "update  Salle set LibelleSalle=?  where CodeSalle=?  ";

$stmt = sqlsrv_prepare($conn, $sql, array(&$Nom,&$Code));
$test=true;
if (!$stmt) {
    //   echo '!sql <br>';
     // die(print_r(sqlsrv_errors(), true));
    $test=false;
}


if (sqlsrv_execute($stmt) === false) {
      //  echo 'type <br>';
      //  die(print_r(sqlsrv_errors(), true));
    $test=false;
}

sqlsrv_free_stmt($stmt);
echo $test;