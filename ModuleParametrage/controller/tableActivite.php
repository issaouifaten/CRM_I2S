<?php


$sql =  "select CodeActivite,LibelleActivite,Designation from Activite
inner join TypeActivite on TypeActivite.TypeActivite=Activite.TypeActivite";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$c=$row['CodeActivite'];
$n=$row['LibelleActivite'];

$spin.="<tr onclick='checkActivite(\"$c\",\"$n\")' > 
<td>".$row['CodeActivite']."</td>";
$spin.="<td>".$row['Designation']."</td> ";
$spin.="<td>".$row['LibelleActivite']."</td> ";


$spin.="</tr> ";




}
echo $spin;
sqlsrv_free_stmt($stmt);