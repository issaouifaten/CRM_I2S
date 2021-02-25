<?php
require "../../Connexion/db.php";
session_start();
$CodeRepresentant=  $_GET['CodeAffect'];

$sql =  " 
select NumeroTache,Tache,Respensable.Nom,Etat.NumeroEtat,Etat.Libelle as Etat ,RaisonSociale from TacheSuivieDeveloppeur
inner Join Respensable on Respensable.CodeRespensable=TacheSuivieDeveloppeur.CodeAffecte
inner join Etat on Etat.NumeroEtat=TacheSuivieDeveloppeur.NumeroEtat 
    inner join Client on Client.CodeClient=TacheSuivieDeveloppeur.CodeClient

where CodeAffecte='$CodeRepresentant' and   convert(date,getdate())  between convert(date,DateDebutPrevu)  and convert(date,DateFinPrevu) 
";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$test=0;
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
 $test=1;
}
echo $test;