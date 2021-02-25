<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
 //"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$code=getCompteurPiece("TacheDeveloppeur");
$CodeClient=$_GET['CodeClient'];
$Module=$_GET['Module'];

$Observation=utf8_decode($_GET['Observation']);
session_start();
$nomuser=  $_SESSION['username'];
$nature=$_GET['nature'];
$type=$_GET['type'];
$checkgroup=$_GET['checkgroup'];
$spinRep=$_GET['spinRep'];
$s =$_GET['array'];

$array=  explode(",",$s[0]);
$test=1;

for ($i=0;$i<count($array);$i++)
{ $codparticipant=$array[$i] ;
$sql="insert into ListParticipantTache(  NumeroTache,CodePersonnel,NumeroOrdre,DateCreation,NomUtilisateur   )
values(?, '$codparticipant',isnull((select isnull(max(NumeroOrdre)+1,1) from ListParticipantTache where NumeroTache=? ),1),getdate(),?)";
// echo $sql."<br>";
    $stmt = sqlsrv_prepare($conn, $sql, array(&$code ,&$code, &$nomuser ));

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

}



$sql =  "insert into  TacheSuivieDeveloppeur(   NumeroTache
      ,CodeClient
      ,Tache
      ,Nature
      ,Type
      ,CodeModule
      ,DateCreation
      ,NomUtilisateur
      ,CodeAffecte
      ,Reponse
      ,CodeDegresImportance
      ,NumeroEtat,NomAffect,Groupe)values
( ?,?,?,'$nature',?,?,getdate(),? ,?,'','','E96'  ,'',?)";
 //echo $sql;
$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$CodeClient,&$Observation, &$type,&$Module,&$nomuser,&$spinRep,&$checkgroup));

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