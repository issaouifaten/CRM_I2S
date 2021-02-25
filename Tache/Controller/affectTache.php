<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
 //parm = "date_debut=" + date_debut + "&date_fin=" + date_fin + "&spinDegres=" + spinDegres +
//           "&txt_reponse="+txt_reponse+"&spinRep="+spinRep+"&CodeTache="+CodeTache;
$code=$_GET['CodeTache'];


$spinRep=$_GET['spinRep'];




session_start();
$nomuser=  $_SESSION['username'];

$sql =  "Update TacheSuivieDeveloppeur 
      set  CodeAffecte=?,NumeroEtat='E97'

 where NumeroTache=?";

$stmt = sqlsrv_prepare($conn, $sql, array( &$spinRep,&$code));
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