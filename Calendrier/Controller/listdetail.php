<?php

require "../../Connexion/db.php";
 $spinRep=$_GET['spinRep'];
 $d1=$_GET['datedebut'];
 $d2=$_GET['datefin'];

$tsql = "[ListeTacheSuivieCRM] N'$spinRep','$d1','$d2'		 ";

$q = sqlsrv_query($conn, $tsql);

$result = array();
$long=0;
do {

    while ($row = sqlsrv_fetch_array($q)) {
        // Loop through each result set and add to result array
        $result[] = $row;

        $CodeAffecte[] =utf8_encode( $row['CodeAffecte']);
        $Duree[] =utf8_encode( $row['Duree']);
        $Tache[] =utf8_encode( $row['Tache']);
        $NumeroTache[] =utf8_encode( $row['NumeroTache']);
        $RaisonSociale[] =utf8_encode( $row['RaisonSociale']);
        $DateDebut[]=date_format($row['DateDebut'],"d/m/Y h:i");
        $DateFin[]=date_format($row['DateFin'],"d/m/Y h:i");
        $DateJour[]=date_format($row['DateJour'],"d/m/Y");

        $long++;



    }
} while (sqlsrv_next_result($q));
$table="";
for ($i=0;$i<$long;$i++)
{
    $table.="<tr>
 <td>".$DateJour[$i] . "<td>
 <td>".$NumeroTache[$i] . "<td>
<td>".$Tache[$i] . "<td>


<td>".$RaisonSociale[$i] . "<td>
<td>".$DateDebut[$i] . "<td>
<td>".$DateFin[$i] . "<td>
<td>".$Duree[$i] . "<td>

</td>
";


}
echo $table;
