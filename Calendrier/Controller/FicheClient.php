<?php

require "../../Connexion/db.php";

$tsql = "
 FicheClient 
	  N'41110435',
	  '19/02/2020',
	  '19/02/2021'";
$q = sqlsrv_query($conn, $tsql);

$result = array();
$totaldebit = 0;
$totalcredit = 0;
$droit = 0;
// Get return value
do {
    while ($row = sqlsrv_fetch_array($q)) {
        // Loop through each result set and add to result array
        $result[] = $row;

        $Libelle[] =utf8_encode( $row['Libelle']);
        $NumeroPIECE[] =utf8_encode( $row['NumeroPiece']);
        $DatePiece[] =date_format( $row['DatePiece'],'d/m/Y');

        $Debit[] = number_format( $row['Debit'],3,"."," ");
        $Credit[] =  number_format($row['Credit'],3,"."," ");




        $totaldebit += $row['Debit'];
                        $totalcredit += $row['Credit'];
                        $soldeligne[] =number_format($totaldebit - $totalcredit,3,"."," ");


    }
} while (sqlsrv_next_result($q));


 $table="";
for ($i=0;$i<count($Libelle);$i++)
{
    $table.="<tr><td>".
    $Libelle[$i]  ."</td><TD>$DatePiece[$i]</TD><td>$NumeroPIECE[$i]</td><td style='text-align:right'>".$Debit[$i]."</td><td style='text-align:right'>".$Credit[$i]."</td><td style='text-align:right'>".$soldeligne[$i]."</td>"."</tr>";
}
echo $table;