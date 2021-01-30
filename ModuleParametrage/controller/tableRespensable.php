<?php


$sql =  "SELECT * from Respensable";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$c=$row['CodeRespensable'];
$n=$row['NomRespensable'];
$a=$row['Actif'];
$spin.="<tr onclick='checkRespensable(\"$c\",\"$n\",\"$a\")' > 
<td>".$row['CodeRespensable']."</td>";
$spin.="<td>".$row['NomRespensable']."</td> ";

if($row['Actif']==1)
{
    $check="checked";
}else   {
    $check="";
}

$spin.=" <td> <input  disabled type='checkbox' $check></td></tr> ";




}
echo $spin;
sqlsrv_free_stmt($stmt);