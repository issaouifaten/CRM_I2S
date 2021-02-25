<?php


//header("Location:index.html");
$name=$_POST['Username'];
$pass=$_POST['pass'];

require "Connexion/db.php" ;

$sql = "SELECT * FROM Utilisateur where NomUtilisateur='".$name."' and MotDePasse='".$pass."'";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );

    echo '<script>alert("Erreur connexion );</script>';

}


$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ;

$m= $row["MotDePasse"];
$CodeRepresentant= $row["CodeRepresentant"];


if($m===$pass)

{

    session_start();



    $_SESSION['pass'] = $pass;
    $_SESSION['username'] = $name;
    $_SESSION['CodeRepresentant'] = $CodeRepresentant;




        header("Location:Tache/ajouttache.php?NomUtilisateur=".$name);






}

else{

    echo '<script>alert(" Verifier vos donnée" );</script>';
    echo '<div class="x_content" style="margin-top: 100px"><center><a href="index.php" class="btn btn-sm btn-success " >Retour   </center></div></a>';




}




sqlsrv_free_stmt( $stmt);


