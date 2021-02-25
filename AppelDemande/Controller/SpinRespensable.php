<?php


$sql =  "SELECT * from Respensable";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="<option  value='' selected>Non Affecté</option>";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $r=  $row['CodeRespensable'];
$spin.="<option value='$r'  >".$row['Nom']."</option>";




}
echo $spin;
sqlsrv_free_stmt($stmt);