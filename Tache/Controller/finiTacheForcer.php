<?php

require "../../Connexion/db.php";

 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;

$CodeTache=$_GET['CodeTache'];

$date_debut= str_replace("T"," ",$_GET['date_debut']) ;
$date_fin= str_replace("T"," ",$_GET['date_fin']) ;
session_start();
$nomuser=  $_SESSION['username'];
$y=substr($date_debut,0,4);
$d=substr($date_debut,5,2);
$m=substr($date_debut,8,2);
$temp=substr($date_debut,10,6);

$date_debut= "$m-$d-$y".$temp;
$y=substr($date_fin,0,4);
$d=substr($date_fin,5,2);
$m=substr($date_fin,8,2);
$temp=substr($date_fin,10,6);

$date_fin= "$m-$d-$y".$temp;
$sql =  "Update TacheSuivieDeveloppeur 
      set   NumeroEtat='E21'
 where NumeroTache=?";

$stmt = sqlsrv_prepare($conn, $sql, array(&$CodeTache));
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


    $sql = "  insert into LigneTacheSuivieDeveloppeur(NumeroTache,NumeroOrdre,DateDebut,DateFin,NomUtilisateur,Terminer )
 values(?, (select isnull(MAX(NumeroOrdre)+1,1)from LigneTacheSuivieDeveloppeur  where NumeroTache=?),'$date_debut','$date_fin',?,1)";


$stmt = sqlsrv_prepare($conn, $sql, array(&$CodeTache,&$CodeTache,&$nomuser));

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


