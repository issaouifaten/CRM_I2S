<?php

session_start();
$nomuser=  $_SESSION['username'];
$CodeRepresentant=$_SESSION['CodeRepresentant'];
$sql =  "SELECT * from Respensable";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}



$spin="<option    >Aucun</option>";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    if($CodeRepresentant==$row['CodeRespensable'])
    {
        $check="selected";
    }else{
        $check="";
    }
$spin.="<option value='".$row['CodeRespensable']."' $check   >".$row['Nom']."</option>";




}
echo $spin;
sqlsrv_free_stmt($stmt);