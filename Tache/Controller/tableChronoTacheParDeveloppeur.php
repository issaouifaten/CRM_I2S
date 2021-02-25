<?php

require "../../Connexion/db.php";

$CodeRepresentant=  $_GET['CodeRepresentant'];
$sql =  " 
select NumeroTache,Tache,Respensable.Nom,Etat.NumeroEtat,Etat.Libelle as Etat ,RaisonSociale 
,DateDebutPrevu,DateFinPrevu,DureeMinute as DureeEstime
from TacheSuivieDeveloppeur
inner Join Respensable on Respensable.CodeRespensable=TacheSuivieDeveloppeur.CodeAffecte
inner join Etat on Etat.NumeroEtat=TacheSuivieDeveloppeur.NumeroEtat 
    inner join Client on Client.CodeClient=TacheSuivieDeveloppeur.CodeClient

where CodeAffecte='$CodeRepresentant' and   convert(date,getdate()) between convert(date,DateDebutPrevu) 
    and convert(date,DateFinPrevu) 
";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
$Nom=$row['Nom'];
$NumeroTache=$row['NumeroTache'];
$Tache=utf8_encode($row['Tache']);
$DureeEstime=utf8_encode($row['DureeEstime']);
$Etat=utf8_encode($row['Etat']);
$NumeroEtat=utf8_encode($row['NumeroEtat']);
$RaisonSociale=utf8_encode($row['RaisonSociale']);
    $DateDebutPrevu =date_format( $row['DateDebutPrevu'],'Y-m-d H:i');

    $DateFinPrevu =date_format( $row['DateFinPrevu'],'Y-m-d H:i');


$NumeroEtat=$row['NumeroEtat'];

$t=str_replace("'"," ",$Tache);

$button="";
if($NumeroEtat=='E66')
{
    $button="<button class='btn btn-sm btn-info' onclick='startTache(\"$NumeroTache\" )' ><i class='fa fa-play-circle'></i></button>";
}else if($NumeroEtat=='E99')
{
    $button="<button class='btn btn-sm btn-success' onclick='pauseTache(\"$NumeroTache\" )' ><i class='fa fa-pause-circle'></i></button>";
    $button.="<button class='btn btn-sm btn-danger' onclick='finiTache(\"$NumeroTache\" ,\"$NumeroEtat\")' ><i class='fa fa-close'></i></button>";
}else if($NumeroEtat=='E100')
{
    $button="<button class='btn btn-sm btn-info' onclick='startTache(\"$NumeroTache\" )'><i class='fa fa-play-circle'></i></button>";
    $button.="<button class='btn btn-sm btn-danger' onclick='finiTache(\"$NumeroTache\" ,\"$NumeroEtat\")'><i class='fa fa-close'></i></button>";
} else if($NumeroEtat=='E21')
    {
        $button="Fini";

    }else if($NumeroEtat=='E96')
{
    $button="non planifier";

}






    $sql_duree="
select isnull(SUM(Duree),0) as DureeTotal from(
select DATEDIFF(MINUTE,DateDebut,DateFin) as Duree from LigneTacheSuivieDeveloppeur
 where	 NumeroTache='$NumeroTache' AND YEAR(DateFin)!=1900 and YEAR(DateDebut)!=1900
union all 
select DATEDIFF(MINUTE,DateDebut,GETDATE()) as Duree from LigneTacheSuivieDeveloppeur
 where Terminer=0 and NumeroTache='$NumeroTache' AND YEAR(DateFin)=1900
) as T
 ";



    $stmt_duree = sqlsrv_query($conn, $sql_duree);
    if ($stmt_duree === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $DureeTotal=0;
    while ($row_duree = sqlsrv_fetch_array($stmt_duree, SQLSRV_FETCH_ASSOC)) {
        $DureeTotal=$row_duree['DureeTotal'];
    }










    $spin.="<tr    > ";
//$spin.="<tr    > ";




$spin.="<td>$Tache</td> ";
$spin.="<td>$RaisonSociale</td> ";
    $spin.="<td>$Etat</td> ";
    $spin.="<td>$DureeEstime</td> ";
$spin.="<td>$DureeTotal (M)</td> ";




$spin.="</tr> ";




}
echo $spin;
sqlsrv_free_stmt($stmt);