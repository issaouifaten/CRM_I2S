<?php

require "../../Connexion/db.php";
$CodeClient  = $_GET['CodeClient'];

$sql =  "select  * from  Document  where CodeAffecte  = '$CodeClient' and CodeNature = '17'  ";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="<option></option>";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $DateAcceuil = date_format($row['DateAcceuil'], 'd/m/Y');
$spin.="<option value='".$row['CodeDocument']."'  >".utf8_encode($row['Libelle'])." ".$DateAcceuil."</option>";




}
echo $spin;
sqlsrv_free_stmt($stmt);