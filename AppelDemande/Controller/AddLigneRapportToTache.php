<?php
require "../../Connexion/db.php";
require "../../CompteurPiece/CompteurPiece.php";
//"Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
//                "&maintenance=" + rd_maintenance + "&Ajout=" + rd_ajout + "&Technique=" + rd_technique+"&Soft="+rd_soft;
$code=getCompteurPiece("TacheDeveloppeur");
//       var url="RepAjout="+RepAjout+"&ModuleAjout="+ModuleAjout+"&description_ajout="+description_ajout+
//           "&datedebut_ajout="+datedebut_ajout+"&datefin_ajout="+datefin_ajout+"&dureeHeure="+dureeHeure+
//                "&dureeMinute="+dureeMinute+"&coderapport="+coderapport ;

$Observation=utf8_decode($_GET['description_ajout']);


$spinRep=$_GET['RepAjout'];
$ModuleAjout=$_GET['ModuleAjout'];
$datedebut_ajout=$_GET['datedebut_ajout'];

$dureeHeure=$_GET['dureeHeure'];

$dureeMinute=$_GET['dureeMinute'];
$coderapport=$_GET['coderapport'];
$duree=$dureeHeure."H".$dureeMinute."Min";

$dureeMinute=$dureeHeure*60+$dureeMinute;

session_start();
$nomuser=  $_SESSION['username'];

if($spinRep=="")
{
    $etat="E96";
}else{
    $etat="E97";
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
      ,NumeroEtat,NomAffect,NumeroAppel ,DateDebutPrevu,DateFinPrevu,Duree,NomPlanificateur,DatePlanification,DureeMinute)values
( '$code',(select CodeClient from AppelDemandeCRM where NumeroAppel='$coderapport'),?
,(select Nature from AppelDemandeCRM where NumeroAppel='$coderapport')
,'A'
,'$ModuleAjout'
,getdate(),'$nomuser','$spinRep',''
,(select CodeDegresImportance from AppelDemandeCRM where NumeroAppel='$coderapport')
,'$etat','','$coderapport','$datedebut_ajout','$datedebut_ajout','$duree','$nomuser',getdate(),$dureeMinute

)";

$stmt = sqlsrv_prepare($conn, $sql, array(&$Observation));
$test=1;
echo $sql;
if (!$stmt) {
      echo $Observation ;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}


if (sqlsrv_execute($stmt) === false) { echo $Observation ;
    //  echo 'type <br>';
   // echo '!sql <br> '.$sql;
    die(print_r(sqlsrv_errors(), true));
    $test=0;
}

sqlsrv_free_stmt($stmt);

$sql="update AppelDemandeCRM set NumeroEtat='E66' where NumeroAppel='$coderapport'";


$stmt = sqlsrv_prepare($conn, $sql, array(&$code,&$Observation));


if (!$stmt) {
    echo "update";
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