<?php
setlocale(LC_TIME, 'fr_FR', 'french', 'fre', 'fra');
require "../Connexion/db.php";
session_start();
if(  $_SESSION['username']=="")
{
    header("location:../index.php");
}
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
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->


    <!-- /.navbar -->
    <?php require "../Menu/menuTop.php" ?>

    <?php include "../Menu/menuLateral.php" ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content bg-white ">
            <div class="container-fluid  ">
                <div class="row p-2">
                    <div class="col-md-12">
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ajout appel</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">


                                <div class="row p-2">
                                    <div class="col-md-2"><LABEL>CLIENT</LABEL></div>
                                    <div class="col-md-6">

                                        <select id="spinClient" class="col-md-8 form-control select2 select2-danger">
                                            <?php require "Controller/SpinClient.php" ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row p-2">

                                    <div class="col-md-2">
                                        <label>Observation</label>
                                    </div>
                                    <div class="col-md-4">
                                        <textarea id="txt_observation" class="form-control" rows="5"></textarea>
                                    </div>

                                </div>
                                <div class="row p-2">
                                    <div class="col-md-2">
                                        <label>Nature</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- radio -->
                                        <div class="form-group clearfix">

                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rd_soft"  >
                                                <label for="rd_soft">
                                                    SOFT
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rd_technique"  >
                                                <label for="rd_technique">
                                                    TECHNIQUE
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-md-2">
                                        <label>suite</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- radio -->
                                        <div class="form-group clearfix">

                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rd_rapport"  >
                                                <label for="rd_rapport">
                                                    Rapport
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-md-2"><LABEL>Affecté à</LABEL></div>
                                    <div class="col-md-6">
                                        <select id="spinRep" class="col-md-8 form-control  select2 select2-danger">
                                            <?php require "Controller/SpinRespensable.php" ?>
                                        </select>
                                    </div>


                                </div>
                                <div class="row p-2">

                                    <div class="col-md-2">
                                        <label>Degres</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="spinDegres" class="col-md-12 form-control select2 select2-danger">
                                            <?php require "Controller/SpinDegres.php" ?>
                                        </select>
                                    </div>

                                </div>





                                <div class="row p-2">
                                    <div class="col-md-6">
                                        <button class="btn btn-info btn-sm" onclick="ajoutTache()">Valider</button>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>


                </div>
            </div>
        </div>
    </div>


</div>


<div class="modal fade" id="ModalErreur" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Erreur </h4>
            </div>
            <div class="modal-body">

                <br>
                <h4><i class="fa fa-exclamation-triangle"></i> <span id="txt_erreur">   </span></h4>


            </div>
            <div class="modal-footer">


                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="ModalSucces" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Ajout </h4>
            </div>
            <div class="modal-body">

                <br>
                <h4> Ligne Ajoutée    </span></h4>


            </div>
            <div class="modal-footer">


                <button class="btn btn-default" data-dismiss="modal" onclick="location.reload();">fermer</button>
            </div>
        </div>

    </div>
</div>

</body>


<script>
    function ajoutTache() {

        var rd_rapport = document.getElementById('rd_rapport').checked;
        var rd_technique = document.getElementById('rd_technique').checked;
         var rd_soft = document.getElementById('rd_soft').checked;
        var  txt_observation = document.getElementById('txt_observation').value;
        var  spinClient = document.getElementById('spinClient').value;

        var spinRep = document.getElementById('spinRep').value;
        var spinDegres = document.getElementById('spinDegres').value;






        if (spinClient == "" || txt_observation == "") {
            document.getElementById('txt_erreur').innerHTML = " Vérifier vos champs";

            $('#ModalErreur').modal('show');

        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.error(this.responseText);


                    if (this.responseText == 1) {
                        $('#ModalSucces').modal('show');


                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                        $('#ModalErreur').modal('show');


                    }


                }
            }





        if(rd_technique)
        {
            rd_technique="T"
        }else{
            rd_technique=""
        }

        if(rd_soft)
        {
            rd_soft="S"
        }else{
            rd_soft=""
        }

        var nature=rd_soft+rd_technique;

        var parm = "Observation=" + txt_observation + "&CodeClient=" + spinClient +
               "&nature="+nature+"&spinRep="+spinRep+"&rd_rapport="+rd_rapport+"&spinDegres="+spinDegres;

            xmlhttp.open("GET", "Controller/ajoutAppel.php?" + parm, true);
            xmlhttp.send();
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

<script>
    $(function () {
        $("#table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

</script>
</body>
</html>