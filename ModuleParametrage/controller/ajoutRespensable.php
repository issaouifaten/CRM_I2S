<?php

require "../../Connexion/db.php";
$Nom=$_GET['Nom'];
$Actif=$_GET['Actif'];
//if ($Actif==true)
//$Actif=1;
//else $Actif=0;
$sql =  "insert into  Respensable(CodeRespensable,NomRespensable,Actif)values
( (select  ISNULL( RIGHT(1000+max(CodeRespensable)+1,3),'001') from Respensable),?,?   )";
//echo $sql.$Nom.$Actif;
$stmt = sqlsrv_prepare($conn, $sql, array(&$Nom,&$Actif));
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