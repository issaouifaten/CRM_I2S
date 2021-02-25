<?php
setlocale(LC_TIME, 'fr_FR', 'french', 'fre', 'fra');
require "../Connexion/db.php";

if (isset($_POST["aller"])) {
    $mm = $_POST["mois"];
    $ans = $_POST["annee"];
    $url = "Calendrier/affiche.php?m=" . $mm . "&y=" . $ans;
    ?>
    <meta http-equiv="refresh" content="0; URL=<?php echo $url ?>">
    <?PHP

}


$codesalle = '';

function getEventsDate($mois, $annee)
{

    session_start();
    $CodeRepresentant=$_SESSION['CodeRepresentant'];
    $result = array();


    require "../Connexion/db.php";

    $tsql = "
DECLARE	@return_value int

EXEC	@return_value = [dbo].[ListeCalendrierTacheSuivieCRM]
		@CodeAffecte = N'$CodeRepresentant',
		 @m='$mois',
		 @y='$annee'";
    $q = sqlsrv_query($conn, $tsql);


    $long=0;
    do {
        while ($row = sqlsrv_fetch_array($q)) {
            // Loop through each result set and add to result array
            $result[] = $row["jour_evenement"];
            $result[] = "  <p  style=' word-break: break-word;
  word-wrap: break-word;font-size: 12px;
  width: 120px;   ' class='bg-blue-grey border '>".$row["RaisonSociale"]."&nbsp ** &nbsp".$row["Duree"]."</p>";
            $long++;



        }
    } while (sqlsrv_next_result($q));

    return $result;
}

function afficheEvent($i, $event)
{
    $texte = "";
    $suivant = false;

    foreach ($event as $cle => $element) {
        if ($suivant) {
            $texte .= "<label>" . $element . "</label><br/>";
        }
        if ($element == $i) {
            $suivant = true;
        } else {
            $suivant = false;
        }
    }

    return $texte;
}

function afficheEventDay($i, $annee, $mois)
{
    $codesalle = '0001';
    $texte = "****";





    return $texte;
}

if (isset($_GET['m']) && isset($_GET['y']) && is_numeric($_GET['m']) && is_numeric($_GET['y'])) {
    $timestamp = mktime(0, 0, 0, $_GET['m'], 1, $_GET['y']);

    $event = getEventsDate($_GET['m'], $_GET['y']); // Récupère les jour où il y a des évènements
} else { // Si on ne récupère rien dans l'url, on prends la date du jour
    $timestamp = mktime(0, 0, 0, date('m'), 1, date('Y'));

    $event = getEventsDate(date('m'), date('Y')); // Récupère les jour où il y a des évènements
}


// === Si le mois correspond au mois actuel et l'année aussi, on retient le jour actuel pour le griser plus tard (sinon le jour actuel ne se situe pas dans le mois)
if (date('m', $timestamp) == date('m') && date('Y', $timestamp) == date('Y')) $coloreNum = date('d');

$m = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "Décembre");
$j = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

$numero_mois = date('m', $timestamp);
$annee = date('Y', $timestamp);

if ($numero_mois == 12) {
    $annee_avant = $annee;
    $annee_apres = $annee + 1;
    $mois_avant = $numero_mois - 1;
    $mois_apres = 01;
} elseif ($numero_mois == 01) {
    $annee_avant = $annee - 1;
    $annee_apres = $annee;
    $mois_avant = 12;
    $mois_apres = $numero_mois + 1;
} else {
    $annee_avant = $annee;
    $annee_apres = $annee;
    $mois_avant = $numero_mois - 1;
    $mois_apres = $numero_mois + 1;
}

// 0 => Dimanche, 1 => Lundi, 2 = > Mardi...
$numero_jour1er = date('w', $timestamp);

// Changement du numéro du jour car l'array commence à l'indice 0
if ($numero_jour1er == 0) $numero_jour1er = 6; // Si c'est Dimanche, on le place en 6ème position (après samedi)
else $numero_jour1er--; // Sinon on mets lundi à 0, Mardi à 1, Mercredi à 2...


?>


<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>I2S</title>


    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
    <!-- Google web Font -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,500">



    <!-- end: Css -->

    <link rel="stylesheet" type="text/css" href="../design/calendrier.css" media="screen"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- /.navbar -->
    <?php require "../Menu/menuTop.php" ?>

    <?php include "../Menu/menuLateral.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12 bg-gradient-white">
                        <h1>
                            <?php echo '<a  class="btn btn-danger" href="?m=' . $mois_avant . '&amp;y=' . $annee_avant . '""> <i class="fa fa-arrow-alt-circle-left"></i>  </a>  '
                                . $m[$numero_mois] . ' ' . $annee . '
                             <a class="btn btn-danger"  href="?m=' . $mois_apres . '&amp;y=' . $annee_apres . '"> <i class="fa fa-arrow-alt-circle-right"></i></a>'; ?></h1>


                        <table class="calendrier table">


                            <tr>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Dimanche</th>
                            </tr>
                            <?php
                            // Ecriture de la 1ère ligne
                            echo '<tr>';
                            // Ecriture de colones vides tant que le mois ne démarre pas
                            for ($i = 0; $i < $numero_jour1er; $i++) {
                                echo '<td></td>';
                            }
                            for ($i = 1; $i <= 7 - $numero_jour1er; $i++) {
                                // Ce jour possède un événement
                                if (in_array($i, $event)) {
                                    echo '<td  class="jourEvenement';

                                    if (isset($coloreNum) && $coloreNum == $i) echo ' lienCalendrierJour';
                                    echo "   onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i.afficheEvent($i, $event) . "</td>";

                                } else {
                                    echo '<td ';

                                    if (isset($coloreNum) && $coloreNum == $i) echo 'class="lienCalendrierJour"';
                                    echo "  onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i.afficheEvent($i, $event) . "</td>";

                                }

                            }
                            echo '</tr>';

                            $nbLignes = ceil((date('t', $timestamp) - ($i - 1)) / 7); // Calcul du nombre de lignes à afficher en fonction de la 1ère (surtout pour les mois a 31 jours)

                            for ($ligne = 0; $ligne < $nbLignes; $ligne++) {
                                echo '<tr>';
                                for ($colone = 0; $colone < 7; $colone++) {
                                    if ($i <= date('t', $timestamp)) {
                                        // Ce jour possède un événement
                                        if (in_array($i, $event)) {
                                            echo '<td class="jourEvenement"';
                                            echo "  onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i.afficheEvent($i, $event) . "</td>";
                                        } else {
                                            echo '<td ';

                                            if (isset($coloreNum) && $coloreNum == $i) echo 'class="lienCalendrierJour"';
                                            echo "  onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i.afficheEvent($i, $event) . "</td>";

                                        }
                                    } else {
                                        echo '<td></td>';
                                    }
                                    $i = $i + 1;
                                }
                                echo '</tr>';
                            }
                            ?>
                        </table>

                        <br/>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
</body>
<!-- end: Javascript -->
<script>

    function affiche(event, day, anne, mois) {
        if (event != "")
            $('#Modal').modal('show');

        document.getElementById('listevent').innerHTML = event;
        document.getElementById('listevent2').innerHTML = event;
        document.getElementById('divDetail').hidden = '';
        document.getElementById('day').innerHTML = day + "/" + mois + "/" + anne;
        document.getElementById('Day').innerHTML = day + "/" + mois + "/" + anne;
        document.getElementById('Day2').innerHTML = day + "/" + mois + "/" + anne;
    }

    function toggleShow(id) {

        if (document.getElementById(id).hidden) {
            document.getElementById(id).hidden = '';
            document.getElementById('btn_toggle').innerHTML = '<i class="fa fa-arrow-circle-up"></i>';

        } else {
            document.getElementById(id).hidden = 'hidden';
            document.getElementById('btn_toggle').innerHTML = '<i class="fa fa-arrow-circle-down"></i>';
        }
    }

</script>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>




</body>
</html>