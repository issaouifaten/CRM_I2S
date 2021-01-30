<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$code=getCompteurPiece("TacheDeveloppeur");
$CodeClient=$_GET['CodeClient'];
$Module=$_GET['Module'];
$Technique=$_GET['Technique'];
$Soft=$_GET['Soft'];
$maintenance=$_GET['maintenance'];
$Ajout=$_GET['Ajout'];
$Observation=utf8_decode($_GET['Observation']);
$nature="";
if($Soft)
{
    $nature+="S";
}
if($Technique)
{
    $nature+="T";
}

if($Ajout)
{$type="A";

}ELSE{
    $type="M";
}


$nomuser="test";

$sql =  "insert into  TacheSuivieDeveloppeur(   NumeroTache
      ,CodeClient
      ,Tache
      ,Nature
      ,Type
      ,CodeModule
      ,DateCreation
      ,NomUtilisateur
      ,NomAffect
      ,Reponse
      ,CodeDegresImportance
      ,NumeroEtat)values
( ?,?,?,?,?,?,getdate(),? ,'','','','E13'  )";
//echo $sql.$Nom.$Actif;
$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$CodeClient,&$Observation,&$nature, &$type,&$Module,&$nomuser));
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