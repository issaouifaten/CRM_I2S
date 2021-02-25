<?php

require "../../Connexion/db.php";

 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$NumeroTache=$_GET['NumeroTache'];
$NumeroEtat=$_GET['NumeroEtat'];


session_start();
$nomuser=  $_SESSION['username'];

$sql =  "Update TacheSuivieDeveloppeur 
      set   NumeroEtat='E21'
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

if($NumeroEtat=='E100') {
    $sql = "  insert into LigneTacheSuivieDeveloppeur(NumeroTache,NumeroOrdre,DateDebut,DateFin,NomUtilisateur,Terminer )
 values(?, (select isnull(MAX(NumeroOrdre)+1,1)from LigneTacheSuivieDeveloppeur  where NumeroTache=?),'',getdate(),?,1)";

}else{
    $sql="update LigneTacheSuivieDeveloppeur set DateFin=GETDATE() ,NomUtilisateur=?,Terminer=1 
 where NumeroTache=? and NumeroOrdre=(select MAX(NumeroOrdre)from LigneTacheSuivieDeveloppeur  where NumeroTache=?)";
}
$stmt = sqlsrv_prepare($conn, $sql, array(&$NumeroTache,&$NumeroTache,&$nomuser));

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