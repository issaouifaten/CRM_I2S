<?php

require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
 //parm = "date_debut=" + date_debut + "&date_fin=" + date_fin + "&spinDegres=" + spinDegres +
//           "&txt_reponse="+txt_reponse+"&spinRep="+spinRep+"&CodeTache="+CodeTache;
$code=$_GET['CodeTache'];
$date_debut= str_replace("T"," ",$_GET['date_debut']) ;
$date_fin= str_replace("T"," ",$_GET['date_fin']) ;
$spinDegres=$_GET['spinDegres'];

$txt_reponse=utf8_decode($_GET['txt_reponse']);

$spinRep=$_GET['spinRep'];
$duree=$_GET['duree'];
$dureeMinute=$_GET['dureeMinute'];
$dureeHeure=$_GET['dureeHeure'];

$dureeTotal=$dureeHeure*60+$dureeMinute;

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
      set  CodeAffecte=?
      ,Reponse=?
      ,CodeDegresImportance=?
      ,DateDebutPrevu='$date_debut'
      ,DateFinPrevu= '$date_fin'
      ,Duree=?
,NomPlanificateur=?
,DatePlanification=getdate()
,NumeroEtat='E66',DureeMinute= $dureeTotal
 where NumeroTache=?";

$stmt = sqlsrv_prepare($conn, $sql, array( &$spinRep,&$txt_reponse,&$spinDegres,&$duree,&$nomuser,&$code));
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