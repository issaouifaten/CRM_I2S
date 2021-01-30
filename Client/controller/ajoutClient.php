<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
// var parm = "Tel=" + text_tel + "&Nom=" + text_nom+"&Mail="+text_email+"&Adresse="
//+text_adresse+"&Site="+text_site+"Observation="+text_observation;

$code=getCompteurPiece("Client");
$Nom=$_GET['Nom'];
$Tel=$_GET['Tel'];
$Mail=$_GET['Mail'];
$Adresse=$_GET['Adresse'];
$Site=$_GET['Site'];
$Observation=$_GET['Observation'];

$sql =  "insert into  Respensable( CodeClient
      ,RaisonSociale
      ,Adresse
      ,Tel
      ,Fax
      ,Mail
      ,SiteWeb
      ,Observation)values
( ?,?,?,?,?,?,?,?   )";
//echo $sql.$Nom.$Actif;
$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$Nom,&$Adresse,&$Tel,"",&$Mail,&$Site,&$Observation));
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