<?php

//
function getCompteurPiece($nomPiecer)
{
    require "../../Connexion/db.php";
    $sql = " select * from CompteurPiece  where NomPiecer='$nomPiecer'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }


    $ltab = 0;
    $t = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $compteur = $row['Compteur'];
        $prefixe = $row['PrefixPiece'];
        $annee = $row['Annee'];

    }

    $code = $prefixe . $annee . $compteur;
    $cod = $code;

    $c = $compteur + 1;
    $qty = sprintf("%05d", $c);

//////
    $sql = "update CompteurPiece set Compteur='$qty'
where NomPiecer='$nomPiecer'";

// Initialise les paramètres et prépare la requête.
// Les variables $qty et $id sont liées à la requête, $stmt.

    $stmt = sqlsrv_prepare($conn, $sql, array());

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    }


    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    return $code;
}
