<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$code=$_GET['CodeTache'];
$CodeClient=$_GET['CodeClient'];
$Module=$_GET['Module'];

$Observation=utf8_decode($_GET['Observation']);

$nature=$_GET['nature'];
$type=$_GET['type'];
$CodeTache=$_GET['CodeTache'];


session_start();
$nomuser=  $_SESSION['username'];

$sql =  "Update TacheSuivieDeveloppeur 
      set  CodeClient=?
      ,Tache=?
      ,Nature=?
      ,Type=?
      ,CodeModule=?
 where NumeroTache=?";

$stmt = sqlsrv_prepare($conn, $sql, array( &$CodeClient,&$Observation,&$nature, &$type,&$Module,&$code));
$test=1;
if (!$stmt) {
    //   echo '!sql <br>';
  die(print_r(sqlsrv_errors(), true));
    $test=0;
}


if (sqlsrv_execute($stmt) === false) {
      //  echo 'type <br>';
      die(print_r(sqlsrv_errors(), true));
    $test=0;
}

sqlsrv_free_stmt($stmt);
echo $test;