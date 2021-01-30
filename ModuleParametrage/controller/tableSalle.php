<?php


$sql =  "SELECT * from Salle";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$c=$row['CodeSalle'];
$n=$row['LibelleSalle'];

$spin.="<tr onclick='checkSalle(\"$c\",\"$n\")' > 
<td>".$row['CodeSalle']."</td>";
$spin.="<td>".$row['LibelleSalle']."</td> ";


$spin.="</tr> ";




}
echo $spin;
sqlsrv_free_stmt($stmt);