<?php
session_start();
$nomuser=  $_SESSION['username'];
require "../../Connexion/db.php";
$code=$_GET['NumeroTache'];
$checkgroup=$_GET['checkgroup'];
$s =$_GET['array'];

$array=  explode(",",$s[0]);
$test=1;

$sql="delete from ListParticipantTache where NumeroTache=?";
// echo $sql."<br>";
$stmt = sqlsrv_prepare($conn, $sql, array(&$code   ));

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

$sql="update TacheSuivieDeveloppeur set Groupe=? where NumeroTache=?";
// echo $sql."<br>";
$stmt = sqlsrv_prepare($conn, $sql, array(&$checkgroup,&$code   ));

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
echo $test;