<?php
setlocale(LC_TIME, 'fr_FR', 'french', 'fre', 'fra');
require "../Connexion/db.php";

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
                <div class="row p-5">
                    <div class="col-md-11">
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste Respensable</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>NOM</th>
                                        <th>ACTIF</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php require "controller/tableRespensable.php" ?>


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-app bg-danger" data-toggle="modal" data-target="#ModalAjout">

                            <i class="fas fa-user-plus"></i> AJOUT
                        </button>

                        <button class="btn btn-app bg-success" data-toggle="modal" data-target="#ModalModif">

                            <i class="fas fa-user-edit"></i> EDIT
                        </button>

                    </div>


                </div>
            </div>
        </div>
    </div>


</div>


<div class="modal fade" id="ModalAjout" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 id="day" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <h4>Ajout Respensable</h4>
                <hr>
                <div class="row">


                    <div class="col-md-6">
                        <label>Nom Respensable</label>
                        <input class="form-control-border " id="txt_nom" type="text">
                    </div>
                    <label class="font-weight-bolder col-md-2">
                        <input class="custom-checkbox" type="checkbox" id="check_actif"> Actif
                    </label>
                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="AddRespensable()"> Valider</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>

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
<div class="modal fade" id="ModalModif" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 id="day" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <h4>Modifier Respensable</h4>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <label>Code</label>
                        <input class="form-control-border " readonly id="txt_code_modif" type="text">
                    </div>

                    <div class="col-md-6">
                        <label>Nom Respensable</label>
                        <input class="form-control-border " id="txt_nom_modif" type="text">
                    </div>
                    <label class="font-weight-bolder col-md-2">
                        <input class="custom-checkbox" type="checkbox" id="check_actif_modif"> Actif
                    </label>
                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="ModifRespensable()"> Valider</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>

            </div>
        </div>

    </div>
</div>

</body>


<script>
    function AddRespensable() {
        var text_nom = document.getElementById('txt_nom').value;
        var check_actif = document.getElementById('check_actif').checked;

        if (text_nom == "") {
            document.getElementById('txt_erreur').innerHTML = " NomRespensable est obligatoire";

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
                    if (this.responseText) {
                        location.reload();
                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL";

                        $('#ModalErreur').modal('show');

                    }


                }
            }
            var parm = "Actif=" + check_actif + "&Nom=" + text_nom;
            xmlhttp.open("GET", "Controller/ajoutRespensable.php?" + parm, true);
            xmlhttp.send();
        }
    }

    function checkRespensable(codeRep, nomRep, actifRep) {

        document.getElementById('txt_nom_modif').value = nomRep;
        document.getElementById('txt_code_modif').value = codeRep;
        if (actifRep == 1)
            document.getElementById('check_actif_modif').checked = true;
        else
            document.getElementById('check_actif_modif').checked = false;
        var table = document.getElementById("table") ; //l'array est stocké dans une variable
        var arrayLignes = document.getElementById("table").rows; //l'array est stocké dans une variable
        var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
        var tr = table.getElementsByTagName("tr");
        var i;
        for (i = 0; i < longueur; i++) {
            var td = tr[i].getElementsByTagName("td")[0];

            if (td) {
                var txtValue = td.textContent || td.innerText;
                //  var txtValue2 = td2.textContent || td2.innerText;
                if (txtValue.toUpperCase().indexOf(codeRep.toUpperCase()) > -1) {
                    tr[i].style.backgroundColor = "#bdcbf5";



                } else {
                    tr[i].style.backgroundColor = "white";
                }
            }else{

            }
        }

    }

    function ModifRespensable() {
        var text_nom = document.getElementById('txt_nom_modif').value;
        var text_code = document.getElementById('txt_code_modif').value;
        var check_actif = document.getElementById('check_actif_modif').checked;

        if (text_nom == "") {
            document.getElementById('txt_erreur').innerHTML = " NomRespensable est obligatoire";

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


                    if (this.responseText) {
                        location.reload();
                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL";

                        $('#ModalErreur').modal('show');

                    }


                }
            }
            var parm = "Actif=" + check_actif + "&Nom=" + text_nom+"&Code="+text_code;
            xmlhttp.open("GET", "Controller/modifRespensable.php?" + parm, true);
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
</script>
</body>
</html>