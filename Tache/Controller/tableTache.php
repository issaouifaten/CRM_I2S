<?php


$sql = "SELECT   NumeroTache
      ,TacheSuivieDeveloppeur.CodeClient
      ,Tache
      ,Nature
      ,Type
      ,ModuleSuivieDeveloppement.Designation
     ,ModuleSuivieDeveloppement.CodeModule
      ,TacheSuivieDeveloppeur.DateCreation
      ,NomUtilisateur
      ,CodeAffecte
      ,Reponse
      ,CodeDegresImportance,DatePlanification ,Groupe
      ,Etat.NumeroEtat,RaisonSociale,Etat.Libelle as Etat,DateDebutPrevu,DateFinPrevu,isnull(Nom,'')as Nom
  FROM  TacheSuivieDeveloppeur
  inner join Client on Client.CodeClient=TacheSuivieDeveloppeur.CodeClient
    inner join ModuleSuivieDeveloppement on ModuleSuivieDeveloppement.CodeModule=TacheSuivieDeveloppeur.CodeModule
    inner join Etat on Etat.NumeroEtat=TacheSuivieDeveloppeur.NumeroEtat
left Join Respensable on Respensable.CodeRespensable=TacheSuivieDeveloppeur.CodeAffecte
  where  TacheSuivieDeveloppeur.NumeroEtat!='E00' ";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin ="";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $CodeClient = $row['CodeClient'];
    $RaisonSociale = utf8_encode($row['RaisonSociale']);
    $NumeroTache = $row['NumeroTache'];
    $Tache = utf8_encode($row['Tache']);
    $Nature = $row['Nature'];
    $Type = $row['Type'];
    $Nom = $row['Nom'];
    $Module = utf8_encode($row['Designation']);
    $CodeModule = $row['CodeModule'];
    $Reponse = utf8_encode($row['Reponse']);
    $Etat = utf8_encode($row['Etat']);
    $NomUtilisateur = $row['NomUtilisateur'];
    $NumeroEtat = $row['NumeroEtat'];
    $CodeAffecte = $row['CodeAffecte'];
    $Groupe = $row['Groupe'];
    $CodeDegresImportance = $row['CodeDegresImportance'];
    $DateDebutPrevu =date_format( $row['DateDebutPrevu'],'Y-m-d H:i');
    $DateDebutPrevu=str_replace(" ","T",$DateDebutPrevu);
    $DateFinPrevu =date_format( $row['DateFinPrevu'],'Y-m-d H:i');
    $DateFinPrevu=str_replace(" ","T",$DateFinPrevu);
    $DateCreation = date_format($row['DateCreation'], 'd/m/Y');
    $DatePlanification = date_format($row['DatePlanification'], 'd/m/Y');
    $style = "";
    if ($NumeroEtat == 'E96') {
        $DateDebutPrevu="";
        $DateFinPrevu="";
    }

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

$date_p= date_format($row['DateDebutPrevu'],"d-m-Y");

if($date_p=='01-01-1900')
    $date_p="";

    $t = str_replace("'", " ", $Tache);
    $rep = str_replace("'", " ", $Reponse);


    if($Groupe==1)
    {
        $sql_part="select CodePersonnel,Nom  from ListParticipantTache
 inner join Respensable 
 on Respensable.CodeRespensable=ListParticipantTache.CodePersonnel
 where NumeroTache='$NumeroTache'

 ";

        $stmt_part = sqlsrv_query($conn, $sql_part);
        if ($stmt_part === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $Nom.='';
        while ($row_part = sqlsrv_fetch_array($stmt_part, SQLSRV_FETCH_ASSOC)) {
            $Nom.=$row_part['Nom'].",";
        }

    }













    $spin .= "<tr   onclick='checkLigne(\"$NumeroTache\",\"$Nature\",\"$t\",\"$CodeModule\",\"$Type\",\"$CodeClient\",\"$DateDebutPrevu\",\"$DateFinPrevu\",\"$CodeAffecte\",\"$rep\",\"$CodeDegresImportance\",\"$Groupe\")'   > ";
//$spin.="<tr    > ";


    $spin .= "<td $style>$icon $Tache</td> ";
    $spin .= "<td>$Nom</td> ";

    $spin .= "<td>$date_p</td> ";
    $spin .= "<td>$RaisonSociale</td> ";
    $spin .= "<td>$Type</td> ";
    $spin .= "<td>$Module</td> ";
    $spin .= "<td>$NomUtilisateur</td> ";
    $spin .= "<td $style >$Etat</td> ";
    $spin .= "<td hidden >$Reponse</td> ";
    $spin .= "<td hidden>$NumeroEtat</td> ";
    $spin .= "<td hidden>$NumeroTache</td> ";


    $spin .= "</tr> ";


}
echo $spin;
sqlsrv_free_stmt($stmt);