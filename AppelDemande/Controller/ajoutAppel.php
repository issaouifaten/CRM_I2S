<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$code=getCompteurPiece("AppelDemandeCRM");
$CodeClient=$_GET['CodeClient'];
$rd_rapport=$_GET['rd_rapport'];

$Observation=utf8_decode($_GET['Observation']);

$nature=$_GET['nature'];

$spinRep=$_GET['spinRep'];
$spinDegres=$_GET['spinDegres'];


session_start();
$nomuser=  $_SESSION['username'];

$sql =  "insert into  AppelDemandeCRM(  NumeroAppel
      ,CodeClient
      ,Description
      ,Nature
      ,DateCreation
      ,NomUtilisateur
      ,CodeAffecte
      ,CodeDegresImportance
      ,Rapport
      ,NumeroEtat)values
( ?,?,?,?,getdate(),? ,?,?,?,'E13')";

$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$CodeClient,&$Observation, &$nature,&$nomuser,&$spinRep,&$spinDegres,&$rd_rapport));
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