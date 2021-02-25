<?php

require "../../Connexion/db.php";

 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$NumeroTache=$_GET['NumeroTache'];


session_start();
$nomuser=  $_SESSION['username'];

$sql =  "Update TacheSuivieDeveloppeur 
      set   NumeroEtat='E100'
 where NumeroTache=?";

$stmt = sqlsrv_prepare($conn, $sql, array(&$NumeroTache));
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

$sql="update LigneTacheSuivieDeveloppeur set DateFin=GETDATE() ,NomUtilisateur=?
 where NumeroTache=? and NumeroOrdre=(select MAX(NumeroOrdre)from LigneTacheSuivieDeveloppeur  where NumeroTache=?)";


$stmt = sqlsrv_prepare($conn, $sql, array(&$nomuser,&$NumeroTache,&$NumeroTache));

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