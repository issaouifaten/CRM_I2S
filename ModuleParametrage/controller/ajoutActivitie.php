<?php

require "../../Connexion/db.php";
$Nom=$_GET['Nom'];
$Type=$_GET['Type'];
//if ($Actif==true)
//$Actif=1;
//else $Actif=0;
$sql =  "insert into  Activite(CodeActivite,LibelleActivite,TypeActivite)values
( (select  ISNULL( RIGHT(1000+max(CodeActivite)+1,3),'001') from Activite),?,?   )";
//echo $sql.$Nom.$Actif;
$stmt = sqlsrv_prepare($conn, $sql, array(&$Nom,&$Type));
$test=true;
if (!$stmt) {
    //   echo '!sql <br>';
     // die(print_r(sqlsrv_errors(), true));
    $test=false;
}


if (sqlsrv_execute($stmt) === false) {
      //  echo 'type <br>';
      //  die(print_r(sqlsrv_errors(), true));
    $test=false;
}

sqlsrv_free_stmt($stmt);
echo $test;