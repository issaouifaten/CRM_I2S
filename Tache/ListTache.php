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
                <div class="row p-1">
                    <div class="col-md-11">
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <div class="row  ">
                                    <input type="text" hidden id="NumeroEtat">

                                    <div class="col-md-2">
                                        CLIENT
                                        <select id="spinClient_recherche"
                                                onchange="     fillListTache(document.getElementById('NumeroEtat').value)"
                                                class="col-md-12 form-control  select2 select2bs4  select2-danger">
                                            <option>Tout</option>
                                            <?php require "Controller/SpinClient.php" ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        Affect
                                        <select id="spinRep_recherche"
                                                onchange="     fillListTache(document.getElementById('NumeroEtat').value)"
                                                class="form-control select2 select2bs4 select2-danger">
                                            <option>Tout</option>
                                            <?php require "Controller/SpinRespensable.php" ?>
                                        </select>


                                    </div>
                                    <div class="col-md-3">
                                        Date
                                        <input type="date" id="date_search" class="form-control"
                                               onchange="     fillListTache(document.getElementById('NumeroEtat').value)">
                                    </div>
                                    <div class="col-md-3">
                                        <br>

                                        <button onclick="fillListTache('E96')" class="btn btn-default">Non Affecté
                                        </button>


                                        <button onclick=" PrintElem('table')" hidden class="btn btn-default">Imprimer
                                        </button>


                                        <button onclick="ImpressionEtat()" class="btn btn-default">Imprimer Etat
                                        </button>


                                    </div>
                                    <div class="col-md-3">
                                        Rapport
                                        <select id="spinRapport_recherche"
                                                onchange="  fillListTache(document.getElementById('NumeroEtat').value) "
                                                class="form-control select2 select2bs4 select2-danger">
                                            <option value=""> Non Affecté</option>
                                            <?php require "Controller/SpinAppel.php" ?>
                                        </select>

                                    </div>


                                </div>


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body overflow-auto" style="max-height: 500px">
                                <table id="table" class="table table-bordered table-striped table-responsive ">
                                    <thead id="header_tab">
                                    <tr>
                                        <th><input type="text" id="0" onkeyup="Search_filtre('0')" placeholder="Tache">
                                        </th>
                                        <th>Affecté</th>
                                        <th>Date_debut</th>
                                        <th>Client</th>

                                        <th><input type="text" style="width: 50px" id="4" onkeyup="Search_filtre('4')"
                                                   placeholder="Type"></th>
                                        <th>Module</th>
                                        <th width="100px"><input style="width: 80px" type="text" id="6"
                                                                 onkeyup="Search_filtre('6')" placeholder="Utilisateur">
                                        </th>
                                        <th>Etat</th>
                                        <th hidden>Eclaircissement</th>
                                        <th hidden></th>
                                        <th hidden></th>
                                        <th>Durée_Réelle</th>
                                        <th>Durée_Estimée</th>


                                    </tr>
                                    </thead>
                                    <tbody style="font-size: 13px" id="dataListTable">
                                    <?php require "Controller/tableTache.php" ?>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="col-md-1 d-none d-lg-block d-sm-block">
                        <a class="btn btn-app bg-danger" href="AjoutTache.php">

                            <i class="fas fa-user-plus"></i> AJOUT
                        </a>
                        <button class="btn btn-app bg-success" data-toggle="modal" data-target="#ModalModif">

                            <i class="fas fa-user-edit"></i> EDIT
                        </button>
                        <button class="btn btn-app bg-info" data-toggle="modal" data-target="#ModalPlanifier">

                            <i class="fas fa-user-edit"></i> Planifier
                        </button>
                        <button class="btn btn-app bg-dark" data-toggle="modal" data-target="#ModalAffecter">

                            <i class="fas fa-user-edit"></i> P.Affecter
                        </button>
                        <button class="btn btn-app bg-blue" data-toggle="modal" data-target="#ModalFinir">

                            <i class="fas fa-close"></i> Finir
                        </button>

                        <button class="btn btn-app bg-danger" data-toggle="modal" data-target="#ModalAnnuler">

                            <i class="fas fa-close"></i> Annuler
                        </button>

                        <span id="spanAlert"> </span>


                    </div>


                </div>
                <br><br><br>
                <br><br><br>
            </div>
        </div>


    </div>

    <footer class="main-footer fixed-bottom">
        <div class="float-right d-lg-none d-md-none ">

            <a class="btn btn-sm bg-danger" href="AjoutTache.php">

                <i class="fas fa-user-plus"></i> AJOUT
            </a>
            <button class="btn btn-sm bg-success" data-toggle="modal" data-target="#ModalModif">

                <i class="fas fa-user-edit"></i> EDIT
            </button>
            <button class="btn btn-sm bg-info" data-toggle="modal" data-target="#ModalPlanifier">

                <i class="fas fa-user-edit"></i> Planifier
            </button>
            <button class="btn btn-sm bg-dark" data-toggle="modal" data-target="#ModalAffecter">

                <i class="fas fa-user-edit"></i> P.Affecter
            </button>
            <button class="btn btn-sm bg-blue" data-toggle="modal" data-target="#ModalFinir">

                <i class="fas fa-close"></i> Finir
            </button>

            <button class="btn btn-sm bg-danger" data-toggle="modal" data-target="#ModalAnnuler">

                <i class="fas fa-close"></i> Annuler
            </button>

        </div>
        <div class="btn-group">
            <button onclick="location.reload()" class="btn btn-default">Tout Mes Taches</button>

            <button onclick="fillListTache('E97')" style='background-color: grey;color: white' class="btn btn-sm"><i
                        class="fa fa-user-check"></i>Non Planifier
            </button>
            <button onclick="fillListTache('E66')" style='background-color: #cc66ff;color: white' class="btn btn-sm"><i
                        class="fa fa-user-check"></i>Planifier
            </button>
            <button onclick="fillListTache('E99')" style='background-color: #009999;color: white' class="btn btn-sm"><i
                        class="fa fa-play-circle"></i> START
            </button>
            <button onclick="fillListTache('E100')" style='background-color: #cc0000;color: white' class="btn btn-sm"><i
                        class="fa fa-pause-circle"></i> PAUSE
            </button>
            <button onclick="fillListTache('E21')" style='background-color: #0a86e9;color: white' class="btn btn-sm"><i
                        class="fa fa-close"></i> FINI
            </button>
        </div>
    </footer>
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
                <div class="div">
                    <div class="row p-2">
                        <div class="col-md-2"><LABEL>Numero</LABEL></div>
                        <div class="col-md-4">
                            <input type="text" readonly id="CodeTache" class="form-control">
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-2"><LABEL>CLIENT</LABEL></div>
                        <div class="col-md-6">

                            <select id="spinClient" class="col-md-6 form-control  ">
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
                                    <input type="checkbox" id="rd_soft">
                                    <label for="rd_soft">
                                        SOFT
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="rd_technique">
                                    <label for="rd_technique">
                                        TECHNIQUE
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-2">
                            <label>Type</label>
                        </div>
                        <div class="col-sm-6">
                            <!-- radio -->
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="rd_maintenance" name="r1" checked>
                                    <label for="rd_maintenance">
                                        Maintenance
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="rd_ajout" name="r1">
                                    <label for="rd_ajout">
                                        Ajout
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-2"><LABEL>Module</LABEL></div>
                        <div class="col-md-6">

                            <select id="spinModule" class="col-md-8 form-control  select2-danger">
                                <?php require "Controller/SpinModule.php" ?>
                            </select>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="ModifTache()"> Modifier</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="ModalPlanifier" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Planifier <span id="tache"></span></h4>
            </div>
            <div class="modal-body">

                <br>

                <div class="row p-2">
                    <div class="col-md-2"><LABEL>Affecté à</LABEL></div>
                    <div class="col-md-6">

                        <select id="spinRep" class="col-md-12 form-control    select2-danger">
                            <?php require "Controller/SpinRespensable.php" ?>
                        </select>
                    </div>


                </div>
                <div class="row p-2">

                    <div class="col-md-2">
                        <label>Eclaircissement</label>
                    </div>
                    <div class="col-md-4">
                        <textarea id="txt_reponse" class="form-control" rows="3"></textarea>
                    </div>

                </div>


                <div class="row p-2">

                    <div class="col-md-2">
                        <label>Degres</label>
                    </div>
                    <div class="col-md-4">
                        <select id="spinDegres" class="col-md-12 form-control   select2-danger">
                            <?php require "Controller/SpinDegres.php" ?>
                        </select>
                    </div>

                </div>

                <div class="row p-2">

                    <div class="col-md-2">
                        <label>DUREE</label>
                    </div>
                    <div class="col-md-4">
                        <input type="datetime-local" onchange="onTimeChange()" class="form-control" id="datedebut">
                    </div>
                    <div class="col-md-4">
                        <input type="datetime-local" onchange="onTimeChange()" class="form-control" id="datefin">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-2">
                        <label></label>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control" id="dureeHeure">H
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="dureeMinute">min
                    </div>
                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="planifierTache()">Planifier</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="ModalAffecter" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Affecter </span></h4>
            </div>
            <div class="modal-body">

                <br>

                <div class="row p-2">
                    <div class="col-md-2"><LABEL>Affecté à</LABEL></div>
                    <div class="col-md-6">

                        <select id="spinRepAffect" class="col-md-12 form-control    select2-danger">
                            <?php require "Controller/SpinRespensable.php" ?>
                        </select>
                    </div>


                    <div class="row p-2">
                        <label><input id="checkgroup" type="checkbox" onclick="toggleShow()">Groupe Affect</label>
                        <div id="divAffectGroup">
                            <table id="table_ajout_ligne_rapport" class="table   ">
                                <tr>
                                    <td><select id="spinRepAjout"
                                                class="form-control   select2-blue">
                                            <?php require "Controller/SpinRespensable.php" ?>
                                        </select></td>


                                    <td></td>
                                    <td>
                                        <button onclick="ajoutLigneAffect()" class="btn btn-info"><i
                                                    class="fa fa-plus"></i></button>
                                    </td>


                                </tr>


                                <tbody id="data_ajout" class="overflow-auto"></tbody>

                            </table>

                        </div>
                    </div>


                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="affecterTache()">Affecter</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="ModalAnnuler" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Annuler <span id="tache"></span></h4>
            </div>
            <div class="modal-body">

                <br>

                <h6>Etes-Vous sur d'annuler cette tache ?</h6>

                <div class="row p-2">

                    <div class="col-md-4">
                        <label id="txt_observation_annulation"></label>
                    </div>

                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="annulerTache()">Confirmer Annulation</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="ModalFinir" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Finir <span id="tache"></span></h4>
            </div>
            <div class="modal-body">

                <br>


                <div class="row p-2">

                    <div class="col-md-2">
                        <label>DUREE</label>
                    </div>
                    <div class="col-md-4">
                        <input type="datetime-local" onchange="onTimeChange()" class="form-control" id="datedebut_fini">
                    </div>
                    <div class="col-md-4">
                        <input type="datetime-local" onchange="onTimeChange()" class="form-control" id="datefin_fini">
                    </div>
                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="finirTache()">Finir</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="ModalGroup" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> ListGroup </h4>
            </div>
            <div class="modal-body">

                <br>


            </div>
            <div class="modal-footer">


                <button class="btn btn-default" data-dismiss="modal">fermer</button>
                <button class="btn btn-danger" onclick="changeListGroupe()">Valider</button>
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


</body>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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

<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
</body>
<script>


    //Initialize Select2 Elements
    $('.select2').select2({})
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

</script>

<script>

    function Search_filtre(val) {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById(val);
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[val];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function checkLigne(codeTache, Nature, Tache, CodeModule, Type, CodeClient, datedebut, datefin, CodeAffecte, Reponse, Degres, checkgroup) {
        if (Nature == "S")
            document.getElementById('rd_soft').checked = true;

        if (Nature == "T")
            document.getElementById('rd_technique').checked = true;


        if (Nature == "ST") {
            document.getElementById('rd_technique').checked = true;
            document.getElementById('rd_soft').checked = true;
        }

        if (Type == "M")
            document.getElementById('rd_maintenance').checked = true;

        if (Type == "A")
            document.getElementById('rd_ajout').checked = true;

        if (checkgroup == "1")
            document.getElementById('checkgroup').checked = true;
        else {
            document.getElementById('checkgroup').checked = false;
        }

        document.getElementById('tache').innerHTML = codeTache + ":" + Tache;
        document.getElementById('txt_observation').value = Tache;
        document.getElementById('spinClient').value = CodeClient;
        document.getElementById('spinModule').value = CodeModule;
        document.getElementById('CodeTache').value = codeTache;

        document.getElementById("datedebut").value = datedebut;
        document.getElementById("datefin").value = datefin;
        document.getElementById("spinRep").value = CodeAffecte;
        document.getElementById("txt_reponse").value = Reponse;
        document.getElementById("spinDegres").value = Degres;

        // annulation
        document.getElementById('txt_observation_annulation').innerHTML = codeTache + ":" + Tache;
        if (datedebut != "") {
            onTimeChange();
        }
        var table = document.getElementById("table"); //l'array est stocké dans une variable
        var arrayLignes = document.getElementById("table").rows; //l'array est stocké dans une variable
        var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
        var tr = table.getElementsByTagName("tr");
        var i;
        for (i = 0; i < longueur; i++) {
            var td = tr[i].getElementsByTagName("td")[10];

            if (td) {
                var txtValue = td.textContent || td.innerText;
                //  var txtValue2 = td2.textContent || td2.innerText;

                if (txtValue.toUpperCase().indexOf(codeTache.toUpperCase()) > -1) {
                    tr[i].style.backgroundColor = "#bdcbf5";


                } else {
                    tr[i].style.backgroundColor = "white";
                }
            } else {

            }
        }


        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                document.getElementById('data_ajout').innerHTML = this.responseText;
                console.error("lstgroup", this.responseText)


            }
        }

        xmlhttp.open("GET", "Controller/listGroupTache.php?NumeroTache=" + codeTache, true);
        console.error("lstgroup", "Controller/listGroupTache.php?NumeroTache=" + codeTache)
        xmlhttp.send();

    }

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function ModifTache() {

        var rd_maintenance = document.getElementById('rd_maintenance').checked;
        var rd_ajout = document.getElementById('rd_ajout').checked;
        var rd_technique = document.getElementById('rd_technique').checked;
        var rd_soft = document.getElementById('rd_soft').checked;
        var txt_observation = document.getElementById('txt_observation').value;
        var spinClient = document.getElementById('spinClient').value;
        var spinModule = document.getElementById('spinModule').value;
        var CodeTache = document.getElementById('CodeTache').value;


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


                    if (this.responseText) {
                        location.reload();
                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL";

                        $('#ModalErreur').modal('show');

                    }


                }
            }

            if (rd_maintenance) {
                rd_maintenance = "M"
            } else {
                rd_maintenance = ""
            }
            if (rd_ajout) {
                rd_ajout = "A"
            } else {
                rd_ajout = ""
            }

            if (rd_technique) {
                rd_technique = "T"
            } else {
                rd_technique = ""
            }

            if (rd_soft) {
                rd_soft = "S"
            } else {
                rd_soft = ""
            }
            var type = rd_ajout + rd_maintenance;
            var nature = rd_soft + rd_technique;

            var parm = "Observation=" + txt_observation + "&CodeClient=" + spinClient + "&Module=" + spinModule +
                "&type=" + type + "&nature=" + nature + "&CodeTache=" + CodeTache;
            xmlhttp.open("GET", "Controller/ModifTache.php?" + parm, true);
            xmlhttp.send();
        }
    }

    function onTimeChange() {
        var date_debut = document.querySelector("#datedebut").value;
        //value start
        var start = Date.parse($("input#datedebut").val()); //get timestamp

        //value end
        var end = Date.parse($("input#datefin").val()); //get timestamp

        totalHours = NaN;
        nbminute = 0;
        if (start < end) {
            totalHours = Math.floor((end - start) / 1000 / 60 / 60); //milliseconds: /1000 / 60 / 60
            totalMinute = Math.floor((end - start) / 1000 / 60); //milliseconds: /1000 / 60 / 60
            nbminute = totalMinute - totalHours * 60;
            document.getElementById("datefin").classList.remove("btn-danger")
        } else {
            document.getElementById("datefin").className = "btn-danger"
        }

        $("#dureeHeure").val(totalHours);
        $("#dureeMinute").val(nbminute);
    }

    function planifierTache() {
        var date_debut = document.querySelector("#datedebut").value;
        var date_fin = document.querySelector("#datefin").value;
        var spinDegres = document.getElementById('spinDegres').value;
        var txt_reponse = document.getElementById('txt_reponse').value;
        var spinRep = document.getElementById('spinRep').value;
        var CodeTache = document.getElementById('CodeTache').value;
        var dureeHeure = document.getElementById('dureeHeure').value;
        var dureeMinute = document.getElementById('dureeMinute').value;
        var duree = dureeHeure + "H" + dureeMinute + "Min"
        var parm = "date_debut=" + date_debut + "&date_fin=" + date_fin + "&spinDegres=" + spinDegres +
            "&txt_reponse=" + txt_reponse + "&spinRep=" + spinRep + "&CodeTache=" + CodeTache + "&duree=" +
            duree + "&dureeHeure=" + dureeHeure + "&dureeMinute=" + dureeMinute;


        // alert(parm)
        if (spinRep == "") {
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


                    if (this.responseText == 1) {
                        location.reload();

                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                        $('#ModalErreur').modal('show');

                    }


                }
            }
        }

        xmlhttp.open("GET", "Controller/planifierTache.php?" + parm, true);
        xmlhttp.send();
    }

    function fillListTache(NumeroEtat) {
        document.getElementById('NumeroEtat').value = NumeroEtat;
        var spinRapport_recherche = document.getElementById('spinRapport_recherche').value;

        if (NumeroEtat == "E96") {
            document.getElementById('spinRep_recherche').value = ""
        }
        var coderep = document.getElementById('spinRep_recherche').value;
        var date_search = document.getElementById('date_search').value;
        var codeclient = document.getElementById('spinClient_recherche').value;
        var condition = ""


        condition += "&CodeAffecte=" + coderep;


        condition += "&CodeClient=" + codeclient;
        condition += "&date_search=" + date_search;
        condition += "&spinRapport_recherche=" + spinRapport_recherche;


        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                document.getElementById('dataListTable').innerHTML = this.responseText;


            }
        }
        var parm = "NumeroEtat=" + NumeroEtat
        console.error("Controller/fill_tableTache_par_etat.php?" + parm + condition)
        xmlhttp.open("GET", "Controller/fill_tableTache_par_etat.php?" + parm + condition, true);
        xmlhttp.send();
        serviceAlertstart();
    }

    function affecterTache() {
        var spinRep = document.getElementById('spinRepAffect').value;
        var CodeTache = document.getElementById('CodeTache').value;

        var parm = "spinRep=" + spinRep + "&CodeTache=" + CodeTache;

        if (spinRep == "") {
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

                    console.error("affect", this.responseText)
                    if (this.responseText == 1) {


                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                        $('#ModalErreur').modal('show');

                    }


                }
            }
        }

        xmlhttp.open("GET", "Controller/affectTache.php?" + parm, true);
        xmlhttp.send();

        changeListGroupe();
    }


    function finirTache() {
        var date_debut = document.querySelector("#datedebut_fini").value;
        var date_fin = document.querySelector("#datefin_fini").value;
        var CodeTache = document.getElementById('CodeTache').value;
        var parm = "date_debut=" + date_debut + "&date_fin=" + date_fin + "&CodeTache=" + CodeTache;

        if (date_debut == "" || date_fin == "") {
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


                    if (this.responseText == 1) {
                        location.reload();

                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                        $('#ModalErreur').modal('show');

                    }


                }
            }
        }

        xmlhttp.open("GET", "Controller/finiTacheForcer.php?" + parm, true);
        xmlhttp.send();
    }

    function deleteAllfiltre() {
        document.getElementById("spinRep_recherche").options[0].text = "Tout";
        document.getElementById('spinRep_recherche').value = "";
        document.getElementById('spinRep_recherche').selectedIndex = 0;
        document.getElementById('date_search').value = "";
        document.getElementById('spinClient_recherche').value = "";
        fillListTache('');
    }

    function ajoutLigneAffect() {

        var Rep = document.getElementById("spinRep").value;
        var RepAjout = document.getElementById("spinRepAjout").value;
        let pos = document.getElementById('spinRepAjout').selectedIndex
        var Nom = document.getElementById("spinRepAjout").options[pos].text;
        //   document.getElementById("spinRepAjout").getElementsByTagName("option")[pos].disabled = true;
        document.getElementById('spinRepAjout').selectedIndex = 0
        var table_ajout_ligne_rapport = document.getElementById("table_ajout_ligne_rapport");

        if (RepAjout == Rep) {
            alert("deja affecte");
        } else if (RepAjout == "" || RepAjout == "Aucun") {

            alert("champs obligatoire")

        } else {


            var ligne = table_ajout_ligne_rapport.insertRow(-1);//on a ajouté une ligne
            var colonne1 = ligne.insertCell(0);

            colonne1.innerHTML = Nom;
            var colonne2 = ligne.insertCell(1);
            colonne2.innerHTML = RepAjout;


            var colonne8 = ligne.insertCell(2);
            colonne8.innerHTML = "<button  onclick='deleteRow(this)'  class='btn btn-danger'><i class='fa fa-close' ></i></button>";


        }
    }

    fillListTache('');


    function changeListGroupe() {
        var spinRep = document.getElementById('spinRep').value;
        var CodeTache = document.getElementById('CodeTache').value;

        var checkgroup = document.getElementById('checkgroup').checked;


        let participant = [];
        if (spinRep != "") {
            participant.push(spinRep);
        }
        var table = document.getElementById("table_ajout_ligne_rapport"); //l'array est stocké dans une variable
        var arrayLignes = document.getElementById("table_ajout_ligne_rapport").rows; //l'array est stocké dans une variable
        var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
        var tr = table.getElementsByTagName("tr");
        var i;
        if (checkgroup == true && longueur == 1) {
            alert("ajouter un persoonnel ")
        } else {


            for (i = 1; i < longueur; i++) {
                var td = tr[i].getElementsByTagName("td")[1];

                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    participant.push(txtValue)

                } else {

                }
            }


            var parm = "NumeroTache=" + CodeTache + "&checkgroup=" + checkgroup + "&array[]=" + participant
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.error("affectgroup", this.responseText)

                    if (this.responseText == 1) {
                        location.reload();

                    } else {
                        document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                        $('#ModalErreur').modal('show');

                    }


                }
            }

            xmlhttp.open("GET", "Controller/modifListGroupAffect.php?" + parm, true);
            xmlhttp.send();
        }

    }


    function toggleShow() {
        //   document.getElementById("divAffectGroup").hidden = !document.getElementById("divAffectGroup").hidden

    }


    function fillListTacheRapport() {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                document.getElementById('dataListTable').innerHTML = this.responseText;


            }
        }
        var parm = "NumeroAppel=";
        console.error("Controller/fill_tableTache_par_etat.php?" + parm + condition)
        xmlhttp.open("GET", "Controller/fill_tableTache_par_etat.php?" + parm + condition, true);
        xmlhttp.send();
    }


    function PrintElem(elem) {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title> Liste des Taches</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write("<h1> Liste des Taches</h1> <style>table {       border-collapse:collapse;        width:90%;    }    th, td {        border:1px solid black;        width:20%;    }    td {        text-align:center;    }</style>");
        mywindow.document.write(document.getElementById(elem).outerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }


    function ImpressionEtat() {
        var spinRep = document.getElementById('spinRep_recherche').value;
        var spinClient_recherche = document.getElementById('spinClient_recherche').value;
        var date_search = document.getElementById('date_search').value;
        var NumeroEtat = document.getElementById('NumeroEtat').value;
        var spinRapport_recherche = document.getElementById('spinRapport_recherche').value;
        var url = "impression/impression_listeTache.php?CodeAffecte=" + spinRep + "&CodeClient=" + spinClient_recherche + "&Date=" + date_search +
            "&NumeroEtat=" + NumeroEtat + "&spinRapport_recherche=" + spinRapport_recherche;
        window.open(url,
            'myWinpdf', 'toolbar=yes,status=yes, resizable=yes,scrollbars=yes,width=1000,height=600');


    }


    function serviceAlertstart() {
        var spinRep_recherche = document.getElementById('spinRep_recherche').value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                if (this.responseText == 1) {
                    document.getElementById('spanAlert').innerHTML = "";

                } else {
                    document.getElementById('spanAlert').innerHTML = "<label class='alert alert-danger'>Aucune TACHE START</label>";

                }


            }
        }


        xmlhttp.open("GET", "Controller/alertStart.php?CodeAffect=" + spinRep_recherche, true);
        xmlhttp.send();
        console.error("Controller/alertStart.php?CodeAffect=" + spinRep_recherche);
    }


    function annulerTache() {
        var CodeTache = document.getElementById('CodeTache').value;


        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                console.error("affect", this.responseText)
                if (this.responseText == 1) {

                   location.reload() ;

                } else {
                    document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                    $('#ModalErreur').modal('show');

                }


            }
        }

        var parm = "CodeTache=" + CodeTache;

        xmlhttp.open("GET", "Controller/annulertache.php?" + parm, true);
        xmlhttp.send();


    }


</script>


</html>