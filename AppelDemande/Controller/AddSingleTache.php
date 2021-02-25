<?php
require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
//"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$code=getCompteurPiece("TacheDeveloppeur");
//  var url="coderapport="+coderapport+"&dureeHeure_plan="+dureeHeure_plan+"&dureeMinute_plan="+dureeMinute_plan+
//            "&spinModulePlan="+spinModulePlan+"&spinRepPlanif="+spinRepPlanif+"&date_debut="+date_debut+
//            "&date_fin="+date_fin;               "&dureeMinute="+dureeMinute+"&coderapport="+coderapport ;




$spinRep=$_GET['spinRepPlanif'];
$ModuleAjout=$_GET['spinModulePlan'];
$datedebut_ajout=$_GET['date_debut'];
$datefin_ajout=$_GET['date_fin'];


$date_debut= str_replace("T"," ",$datedebut_ajout) ;
$date_fin= str_replace("T"," ",$datefin_ajout) ;
$dureeHeure=$_GET['dureeHeure_plan'];

$dureeMinute=$_GET['dureeMinute_plan'];
$coderapport=$_GET['coderapport'];
$duree=$dureeHeure."H".$dureeMinute."Min";
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
session_start();
$nomuser=  $_SESSION['username'];

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
      ,NumeroEtat,NomAffect,NumeroAppel ,DateDebutPrevu,DateFinPrevu,Duree,NomPlanificateur,DatePlanification)values
( ?,(select CodeClient from AppelDemandeCRM where NumeroAppel='$coderapport')
 
,(select Description from AppelDemandeCRM where NumeroAppel='$coderapport')
,(select Nature from AppelDemandeCRM where NumeroAppel='$coderapport')
,'A'
,'$ModuleAjout'
,getdate(),'$nomuser','$spinRep',''
,(select CodeDegresImportance from AppelDemandeCRM where NumeroAppel='$coderapport')
,'E66','','$coderapport','$date_debut','$date_fin','$duree','$nomuser',getdate()

)";

$stmt = sqlsrv_prepare($conn, $sql, array(&$code));
$test=1;

if (!$stmt) {
      echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}


if (sqlsrv_execute($stmt) === false) {
    //  echo 'type <br>';
    echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}

sqlsrv_free_stmt($stmt);

$sql="update AppelDemandeCRM set NumeroEtat='E66' where NumeroAppel='$coderapport'";


$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$Observation));


if (!$stmt) {
    echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}


if (sqlsrv_execute($stmt) === false) {
    //  echo 'type <br>';
    echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}





echo $test;