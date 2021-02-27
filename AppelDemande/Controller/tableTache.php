<?php


$sql = "select NumeroAppel,AppelDemandeCRM.CodeClient,RaisonSociale,Nature,AppelDemandeCRM.DateCreation,CodeDegresImportance,
AppelDemandeCRM.NomUtilisateur,Description
,CodeAffecte,Respensable.Nom ,Rapport,AppelDemandeCRM.NumeroEtat,Etat.Libelle as Etat
from AppelDemandeCRM
inner join Client on Client.CodeClient=AppelDemandeCRM.CodeClient
left join Respensable on Respensable.CodeRespensable=AppelDemandeCRM.CodeAffecte
inner join Etat on Etat.NumeroEtat=AppelDemandeCRM.NumeroEtat ";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin ="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $CodeClient = $row['CodeClient'];
    $RaisonSociale = utf8_encode($row['RaisonSociale']);
    $NumeroAppel = $row['NumeroAppel'];
    $Description = utf8_encode($row['Description']);
    $Nature = $row['Nature'];

    $Nom = $row['Nom'];


    $Etat = utf8_encode($row['Etat']);
    $NomUtilisateur = $row['NomUtilisateur'];
    $NumeroEtat = $row['NumeroEtat'];
    $CodeAffecte = $row['CodeAffecte'];
    $CodeDegresImportance = $row['CodeDegresImportance'];
    $Rapport = $row['Rapport'];

    $DateCreation = date_format($row['DateCreation'], 'd/m/Y');

    $style = "";


    switch ($NumeroEtat) {

        case 'E96':
            $style = " ";
            break;
        case 'E66':
            $style = "style='background-color: #cc66ff' ";
            break;
        case 'E99':
            $style = "style='background-color: #009999' ";
            break;
        case 'E100':
            $style = "style='background-color: #cc0000' ";
            break;
        case 'E21':
            $style = "style='background-color: #0a86e9' ";
            break;

    }


    switch ($Nature)
    {
        case 'S':$icon="<i class='fa fa-laptop'></i>";
        break;
        case 'T':$icon="<i class='fa fa-cog'></i>";
            break;
        case 'ST':$icon="<i class='fa fa-cog'><i class='fa fa-laptop'></i>";
            break;
        default:$icon='';
    }
    $check="";
if($Rapport==1)
{
    $check="<input type='checkbox' checked disabled >";
}else{
    $check="<input type='checkbox'   disabled>";
}



    $t = str_replace("'", " ", $Description);


    $spin .= "<tr   onclick='checkLigne(\"$NumeroAppel\",\"$Nature\",\"$t\",\"$CodeClient\",\"$CodeAffecte\",\"$CodeDegresImportance\",\"$Rapport\")'   > ";
//$spin.="<tr    > ";


    $spin .= "<td $style>$icon $Description <SPAN class='font-weight-bold  ' style='color: maroon'>($DateCreation)</SPAN> </td> ";
    $spin .= "<td>$Nom</td> ";
     $spin .= "<td>$RaisonSociale</td> ";
    $spin .= "<td>$DateCreation</td> ";
    $spin .= "<td>$NomUtilisateur</td> ";
    $spin .= "<td>$check</td> ";
    $spin .= "<td $style >$Etat</td> ";
    $spin .= "<td hidden>$NumeroEtat</td> ";
    $spin .= "<td hidden>$NumeroAppel</td> ";


    $spin .= "</tr> ";


}
echo $spin;
sqlsrv_free_stmt($stmt);