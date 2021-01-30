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
    $result = array();
    $codesalle = '0001';

    require "../Connexion/db.php";
    $sql = "SELECT jour_evenement,mois_evenement,annee_evenement,RaisonSociale ,HeurDebut,HeurFin,CodeActivite FROM Calendrier 
inner join Reservation on Reservation.CodeReservation=Calendrier.CodeReservation 
where mois_evenement=$mois  and annee_evenement=$annee";

    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $result[] = $row["jour_evenement"];
        $result[] = $row["RaisonSociale"];


    }
    sqlsrv_free_stmt($stmt);

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
    $texte = "";

    require "../Connexion/db.php";
    $sql = "SELECT jour_evenement,mois_evenement,annee_evenement,RaisonSociale ,HeurDebut,HeurFin,LibelleActivite ,Tel FROM Calendrier 
inner join Reservation on Reservation.CodeReservation=Calendrier.CodeReservation 
where mois_evenement=$mois  and annee_evenement=$annee  and jour_evenement=$i   ORDER BY jour_evenement ";


    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

        $texte .= "<tr><td>" . $row["RaisonSociale"] . "</td>";
        $texte .= "<td>" . $row["Tel"] . "</td>";
        $texte .= "<td>" . $row["LibelleActivite"] . "</td>";
        $texte .= "<td>" . date_format($row["HeurDebut"], 'h:i') . "</td>";
        $texte .= "<td>" . date_format($row["HeurFin"], 'h:i') . "</td></tr>";


    }
    sqlsrv_free_stmt($stmt);

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

                    <div class="col-md-6 bg-gradient-white">
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
                                    echo "   onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i . "</td>";

                                } else {
                                    echo '<td ';

                                    if (isset($coloreNum) && $coloreNum == $i) echo 'class="lienCalendrierJour"';
                                    echo "  onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i . "</td>";

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
                                            echo "  onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i . "</td>";
                                        } else {
                                            echo '<td ';

                                            if (isset($coloreNum) && $coloreNum == $i) echo 'class="lienCalendrierJour"';
                                            echo "  onclick=\"affiche('" . afficheEventDay($i, $annee, $numero_mois) . "','" . $i . "','" . $annee . "','" . $numero_mois . "')\" >   " . $i . "</td>";

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
                    <div class="col-md-6 bg-gradient-white" id="divDetail">
                        <div class="row p1" >
                            <div class="col-md-6   ">
                                <h3> <i class="fa fa-calendar"></i>
                                 <span   id="Day"></span></h3>
                            </div>
                        <div class="col-md-6  ">

                            <h3> <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-danger btn-sm  right " data-toggle="modal"
                                    data-target="#ModalAjoutReservation"> <i class="fa fa-plus"></i> Ajout Reservation
                            </button>
                            </h3>
                        </div>
                        </div>
                        <div class="border" style="overflow: auto;height: 250px">
                            <table class="table table-bordered table-striped">
                                <thead class="table-danger-head table-striped">
                                <th><i class="fa fa-user"></i> Client</th>
                                <th><i class="fa fa-phone"></i> Tel</th>
                                <th>Activité</th>
                                <th>Début</th>
                                <th>Fin</th>
                                </thead>
                                <tbody id="listevent2"></tbody>
                            </table>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header alert-red">

                    <h4 id="day" class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <br>
                    <table class="table table-bordered">
                        <thead>
                        <th><i class="fa fa-user"></i> Client</th>
                        <th><i class="fa fa-phone"></i> Tel</th>
                        <th>Activité</th>
                        <th>Début</th>
                        <th>Fin</th>
                        </thead>
                        <tbody id="listevent"></tbody>
                    </table>
                    <div id="divAddEvent">


                    </div>


                </div>
                <div class="modal-footer">


                    <button class="btn btn-default" data-dismiss="modal">fermer</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade  " id="ModalAjoutReservation" role="dialog">
        <div class="modal-dialog modal-lg">
            
            <!-- Modal content-->
            <div class="modal-content modal-lg">
                <div class="modal-header bg-danger">

                    <h4 id="Day2" class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <div id="divAjoutReservation">
                        <div class="row p-3">
                            <div class="col-md-2">.</div>
                            <div class="col-md-4">
                                <label>Heure Debut </label>
                                <input type="time" id="heurdebut">
                            </div>
                            <div class="col-md-4">
                                <label>Heure Fin </label>
                                <input type="time" id="heurfin">
                            </div>

                        </div>
                        <div class="row ">


                            <div class="col-md-3">


                                <div class="form-group">

                                    <select id="spinClient" class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <?php include "Controller/SpinClient.php" ?>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">


                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nom Prenom">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <input class="form-control" autocomplete="off" type="text" placeholder="tel"
                                           Pattern="[0-9]{8}"
                                           size="8"
                                           minlength="8"
                                           maxlength="8" required id="telclient">
                                </div>
                            </div>


                        </div>
                        <div class="row p-3">
                            <div class="col-md-6">
                                <LABEL>Salle : </LABEL>
                                <select is="spinSalle" class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger">
                                    <?php include "Controller/SpinSalle.php" ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <LABEL>Respensable : </LABEL>
                                <select is="spinRespensable" class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger">
                                    <?php include "Controller/SpinRespensable.php" ?>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <LABEL>Soin</LABEL>

                                <select is="spinActivite" class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger">
                                    <?php include "Controller/SpinActivite.php" ?>
                                </select>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">


                    <button class="btn btn-default" data-dismiss="modal">fermer</button>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
<!-- end: Javascript -->
<script>
    document.getElementById('divDetail').hidden = 'hidden';

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

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
</script>

</body>
</html>