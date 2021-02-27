<?php


$sql =  " select  NumeroAppel,Description,DateCreation from AppelDemandeCRM";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $DateCreation = date_format($row['DateCreation'], 'd/m/Y');
$spin.="<option value='".$row['NumeroAppel']."'  >".utf8_encode($row['Description'])." ($DateCreation)</option>";




}
echo $spin;
sqlsrv_free_stmt($stmt);