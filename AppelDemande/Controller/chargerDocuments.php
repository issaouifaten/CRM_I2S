<?php

require "../../Connexion/db.php";
$CodeDoc  = $_GET['CodeDocument'];

$sql = "  select *from UrlGED  ";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}


$URL = "" ;


while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $URL  = $row['URL'];
}





$sql = "  select url ,Archive,NArchive,Attache,NPiece,Reference , isnull(TypeDocument.Libelle ,'')as Type
FROM LigneDocument
 left join TypeDocument on TypeDocument.CodeType=LigneDocument.Type 
 where CodeDocument='$CodeDoc' ";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$spin="";


/*while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $DateAcceuil = date_format($row['DateAcceuil'], 'd/m/Y');
$spin.="<option value='".$row['CodeDocument']."'  >".utf8_encode($row['Libelle'])." ".$DateAcceuil."</option>";
}*/



while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

    $contenu_ligne = "Uploads/" . $row['url'];
    $NArchive_ligne = $row['NArchive'];
    $Archive_ligne = $row['Archive'];
    $Attache_ligne = $row['Attache'];
    $NPiece_ligne= $row['NPiece'];
    $Reference = $row['Reference'];
    $type_ligne= $row['Type'];

$url_image=$URL."Uploads/" . $row['url'];

 if($type_ligne=== 'pdf')
 {
     $spin.="<iframe frameborder='0' width='100%' height='800' src='$url_image'></iframe>";
 }

    if($type_ligne=== 'image')
    {
        $spin.= " <div class='col-md-12'> <img class='img-fluid   img-responsive' src='$url_image' > </div>";
    }


}



echo $spin;
sqlsrv_free_stmt($stmt);