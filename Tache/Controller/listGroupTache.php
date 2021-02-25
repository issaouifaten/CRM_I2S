<?php


require "../../Connexion/db.php";
$NumeroTache=$_GET['NumeroTache'];
$sql_part="select CodePersonnel,Nom  from ListParticipantTache
 inner join Respensable 
 on Respensable.CodeRespensable=ListParticipantTache.CodePersonnel
 where NumeroTache='$NumeroTache'

 ";

$stmt_part = sqlsrv_query($conn, $sql_part);
if ($stmt_part === false) {
    die(print_r(sqlsrv_errors(), true));
}

$Nom="";
while ($row_part = sqlsrv_fetch_array($stmt_part, SQLSRV_FETCH_ASSOC)) {
    $Nom.="<tr>";
    $Nom.="<td>".$row_part['Nom']." </td>";
    $Nom.="<td>".$row_part['CodePersonnel']." </td>";

    $Nom.="<td> <button  onclick='deleteRow(this)'  class='btn btn-danger'><i class='fa fa-close' ></i></button></td>";
    $Nom.="</tr>";
}
echo $Nom;