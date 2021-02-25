<?php

require "../../Connexion/db.php";

 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$NumeroTache=$_GET['NumeroTache'];


session_start();
$nomuser=  $_SESSION['username'];

$sql =  "Update TacheSuivieDeveloppeur 
      set   NumeroEtat='E99'
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

$sql="  insert into LigneTacheSuivieDeveloppeur(NumeroTache,NumeroOrdre,DateDebut,DateFin,NomUtilisateur,Terminer )
 values(?, (select isnull(MAX(NumeroOrdre)+1,1)from LigneTacheSuivieDeveloppeur  where NumeroTache=?),getdate(),'',?,0)";

$test1=1;
$stmt = sqlsrv_prepare($conn, $sql, array(&$NumeroTache,&$NumeroTache,&$nomuser));

if (!$stmt) {
    //   echo '!sql <br>';
    die(print_r(sqlsrv_errors(), true));
    $test1=0;
}


if (sqlsrv_execute($stmt) === false) {
    //  echo 'type <br>';
    die(print_r(sqlsrv_errors(), true));
    $test1=0;
}

sqlsrv_free_stmt($stmt);
$t=$test*$test1;
echo $t;