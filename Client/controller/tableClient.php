<?php


$sql =  "SELECT * from Client";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$CodeClient=$row['CodeClient'];
$RaisonSociale=$row['RaisonSociale'];
$Adresse=$row['Adresse'];
$Fax=$row['Fax'];
$Mail=$row['Mail'];
$SiteWeb=$row['SiteWeb'];
$Observation=$row['Observation'];

$spin.="<tr onclick='checkClient(\"$CodeClient\",\"$RaisonSociale\",\"$Adresse\")' > ";

$spin.="<td>$CodeClient</td> ";
$spin.="<td>$RaisonSociale</td> ";
$spin.="<td>$Adresse</td> ";
$spin.="<td>$Fax</td> ";
$spin.="<td>$Mail</td> ";
$spin.="<td>$SiteWeb</td> ";
$spin.="<td>$Observation</td> ";



$spin.="</tr> ";




}
echo $spin;
sqlsrv_free_stmt($stmt);