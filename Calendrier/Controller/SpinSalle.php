<?php


$sql =  "SELECT * from Salle";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

$spin.="<option value='".$row['CodeSalle']."'  >".$row['LibelleSalle']."</option>";




}
echo $spin;
sqlsrv_free_stmt($stmt);