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
                                <!--                                <div class="row  ">-->
                                <!---->
                                <!--                                    <div class="col-md-1 d-none d-lg-block d-sm-block"><LABEL>CLIENT</LABEL></div>-->
                                <!--                                    <div class="col-md-3">-->
                                <!---->
                                <!--                                        <select id="spinClient_recherche"-->
                                <!--                                                onchange="     fillListTache(document.getElementById('NumeroEtat').value)"-->
                                <!--                                                class="form-control select2 select2-danger">-->
                                <!--                                            <option>Tout</option>-->
                                <!--                                            --><?php //require "Controller/SpinClient.php" ?>
                                <!--                                        </select>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="col-md-1 d-none d-lg-block d-sm-block"><LABEL>Affect</LABEL></div>-->
                                <!--                                    <div class="col-md-3">-->
                                <!---->
                                <!--                                        <select id="spinRep_recherche"-->
                                <!--                                                onchange="     fillListTache(document.getElementById('NumeroEtat').value)"-->
                                <!--                                                class="form-control select2 select2-danger">-->
                                <!--                                            <option>Tout</option>-->
                                <!--                                            --><?php //require "Controller/SpinRespensable.php" ?>
                                <!--                                        </select>-->
                                <!--                                    </div>-->
                                <!---->
                                <!---->
                                <!--                                </div>-->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead id="header_tab">
                                    <tr>
                                        <th>Tache</th>
                                        <th>Affecté</th>
                                        <th>Client</th>
                                        <th>Date creation</th>


                                        <th>Utilisateur</th>
                                        <th>Rapport</th>
                                        <th>Etat</th>

                                        <th hidden></th>
                                        <th hidden></th>


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

                        <button class="btn btn-app bg-success" data-toggle="modal" data-target="#ModalModif">

                            <i class="fas fa-eye"></i> Consulter
                        </button>
                        <button class="btn btn-app bg-pink"  onclick="showModalRapport()">

                            <i class="fas fa-plus"></i> Rapport
                        </button>
                        <button class="btn btn-app bg-dark" data-toggle="modal" data-target="#ModalConsulte">

                            <i class="fas fa-book"></i> Detail
                        </button>
                        <button class="btn btn-app bg-info" data-toggle="modal" data-target="#ModalPlanifier">

                            <i class="fas fa-arrow-circle-down "></i> Tache
                        </button>
                        <button class="btn btn-app bg-red" data-toggle="modal" data-target="#ModalAnnuler">

                            <i class="fas fa-close "></i> Annuler
                        </button>

                    </div>


                </div>
                <br><br><br>
                <br><br><br>
            </div>
        </div>


    </div>

    <footer class="main-footer fixed-bottom">
        <div class="float-right d-lg-none d-md-none ">


            <button class="btn btn-sm bg-success" data-toggle="modal" data-target="#ModalModif">

                <i class="fas fa-user-edit"></i> EDIT
            </button>
            <button class="btn btn-sm bg-danger"  onclick="showModalRapport()">

                <i class="fas fa-add"></i> Rapport
            </button>
            <button class="btn btn-sm bg-dark" data-toggle="modal" data-target="#ModalConsulte">

                <i class="fas fa-book"></i> Consult
            </button>

        </div>
        <div class="btn-group" hidden>
            <button onclick="location.reload()" class="btn btn-default">Tout</button>
            <button onclick="fillListTache('E96')" class="btn btn-default"><i class="fa fa-user"></i>Non Affecté
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
                <h4>Modifier </h4>
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
                        <div class="col-md-4">

                            <select id="spinClient" readonly class="col-md-6 form-control select2 select2-danger">
                                <?php require "Controller/SpinClient.php" ?>
                            </select>
                        </div>
                    </div>
                    <div class="row p-2">

                        <div class="col-md-2">
                            <label>Observation</label>
                        </div>
                        <div class="col-md-4">
                            <textarea id="txt_observation" readonly class="form-control" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="row p-2">
                        <div class="col-md-2">
                            <label>Nature</label>
                        </div>
                        <div class="col-sm-4">
                            <!-- radio -->
                            <div class="form-group clearfix">

                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" readonly id="rd_soft">
                                    <label for="rd_soft">
                                        SOFT
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" readonly id="rd_technique">
                                    <label for="rd_technique">
                                        TECHNIQUE
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Type</label>
                        </div>
                        <div class="col-sm-4">
                            <!-- radio -->
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="rd_maintenance" readonly name="r1" checked>
                                    <label for="rd_maintenance">
                                        Maintenance
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="rd_ajout" readonly name="r1">
                                    <label for="rd_ajout">
                                        Ajout
                                    </label>
                                </div>

                            </div>
                        </div>


                    </div>


                    <div class="row p-2">
                        <div class="col-md-2">
                            <label>suite</label>
                        </div>
                        <div class="col-sm-4">
                            <!-- radio -->
                            <div class="form-group clearfix">

                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" readonly id="rd_rapport">
                                    <label for="rd_rapport">
                                        Rapport
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Degres</label>
                        </div>
                        <div class="col-md-4">
                            <select id="spinDegres" readonly class="col-md-12 form-control select2 select2-danger">
                                <?php require "Controller/SpinDegres.php" ?>
                            </select>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-md-2"><LABEL>affecté</LABEL></div>
                        <div class="col-md-6">

                            <select id="spinAffect" readonly class="col-md-8 form-control  select2-danger">
                                <?php require "Controller/SpinRespensable.php" ?>
                            </select>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->


            </div>
            <div class="modal-footer">


                <button hidden class="btn btn-danger" onclick="ModifTache()"> Modifier</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>

            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="ModalRapport" role="dialog">
    <div class="modal-dialog  modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Rapport </h4>
            </div>
            <div class="modal-body d-flex">

                <br>


                <table id="table_ajout_ligne_rapport" class="table   table-bordered">
                    <tr>
                        <td><select id="spinRepAjout">
                                <?php require "Controller/SpinRespensable.php" ?>
                            </select></td>
                        <td><select id="spinModuleAjout">
                                <?php require "Controller/SpinModule.php" ?>
                            </select></td>
                        <td><textarea type="text" id="txt_description_ajout"
                                      placeholder="description"></textarea></td>
                        <td><input type="date" id="txt_datedebut_ajout"

                                   id="datedebut"></td>

                        <td><input style="width: 70px" type="number" value="0" id="dureeHeure">H</td>
                        <td><input style="width: 70px" type="number" value="0" id="dureeMinute">min</td>
                        <td>
                            <button onclick="ajoutLigneRapport()" class="btn btn-info"><i class="fa fa-plus"></i>
                            </button>
                        </td>


                    </tr>


                    <tbody id="data_ajout" class="overflow-auto"></tbody>

                </table>


            </div>
            <div class="modal-footer">


                <button class="btn btn-default" onclick="ValiderRapport()">Valider</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="ModalConsulte" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Detail </h4>
            </div>
            <div class="modal-body">

                <br>
                <h4>
                    <table class="table table-bordered  "   style=" font-size: 14px;display: block;
  height: 500px;
  overflow-y: scroll;" >
                        <thead id="header_tab">
                        <tr>
                            <th>Tache</th>
                            <th>Affecté</th>
                            <th>Date_debut</th>
                            <th>Client</th>

                            <th>Type</th>
                            <th>Module</th>
                            <th>Utilisateur</th>
                            <th>Etat</th>
                            <th hidden>Eclaircissement</th>
                            <th hidden></th>
                            <th hidden></th>


                        </tr>
                        </thead>
                        <tbody id="data_consult"  ></tbody>
                    </table>
                </h4>


            </div>
            <div class="modal-footer">


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

                        <select id="spinRepPlanif" class="col-md-12 form-control   select2-danger">
                            <?php require "Controller/SpinRespensable.php" ?>
                        </select>
                    </div>


                </div>


                <div class="row p-2">

                    <div class="col-md-2">
                        <label>Module</label>
                    </div>

                    <select id="spinModulePlan">
                        <?php require "Controller/SpinModule.php" ?>
                    </select>
                </div>
                <div class="row p-2">

                    <div class="col-md-2">
                        <label>DUREE</label>
                    </div>
                    <div class="col-md-4">
                        <input type="datetime-local" onchange="onTimeChangePlannif()" class="form-control"
                               id="datedebut">
                    </div>
                    <div class="col-md-4">
                        <input type="datetime-local" onchange="onTimeChangePlannif()" class="form-control" id="datefin">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-2">
                        <label></label>
                    </div>

                    <div class="col-md-2">
                        <input type="number" readonly class="form-control" min="0" id="dureeHeure_plan">H
                    </div>
                    <div class="col-md-2">
                        <input type="number" readonly class="form-control" min="0"  id="dureeMinute_plan">min
                    </div>
                </div>


            </div>
            <div class="modal-footer">


                <button class="btn btn-danger" onclick="addSingleTache()">Planifier</button>
                <button class="btn btn-default" data-dismiss="modal">fermer</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="ModalAnnuler" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-red">

                <h4 class="modal-title"> Annuler </h4>
            </div>
            <div class="modal-body">

                <br>
                <h4>Vouler Vous vraiment Annuler la tache   </span></h4>


            </div>
            <div class="modal-footer">


                <button class="btn btn-default" onclick="AnnulerDemande()">Annuler Tache</button>
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


</body>


</body>
<script>


</script>

<script>

    function Search_filtre(val) {
        var input, filter, table, tr, td, i, txtValue;

        filter = val.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");

        if (filter.toUpperCase().indexOf('TOUT') == 0) {

            for (i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        } else {

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    console.error(i + txtValue + "*" + filter);
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";

                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }

    //checkLigne(\"$NumeroAppel\",\"$Nature\",\"$t\",\"$CodeClient\",\"$CodeAffecte\",\"$CodeDegresImportance\"
    function checkLigne(codeTache, Nature, Tache, CodeClient, CodeAffecte, Degres, rapport) {
        if (Nature == "S")
            document.getElementById('rd_soft').checked = true;

        if (Nature == "T")
            document.getElementById('rd_technique').checked = true;


        if (Nature == "ST") {
            document.getElementById('rd_technique').checked = true;
            document.getElementById('rd_soft').checked = true;
        }


        //  document.getElementById('tache').innerHTML = codeTache + ":" + Tache;
        document.getElementById('txt_observation').value = Tache;
        document.getElementById('spinClient').value = CodeClient;

        document.getElementById('CodeTache').value = codeTache;

        document.getElementById('rd_rapport').checked = rapport;


        document.getElementById("spinAffect").value = CodeAffecte;
        document.getElementById("spinRepAjout").value = CodeAffecte;
        document.getElementById("spinRepPlanif").value = CodeAffecte;

        document.getElementById("spinDegres").value = Degres;

        var table = document.getElementById("table"); //l'array est stocké dans une variable
        var arrayLignes = document.getElementById("table").rows; //l'array est stocké dans une variable
        var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
        var tr = table.getElementsByTagName("tr");
        var i;
        for (i = 0; i < longueur; i++) {
            var td = tr[i].getElementsByTagName("td")[8];

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

            document.getElementById('data_consult').innerHTML = this.responseText;


        }
        xmlhttp.open("GET", "Controller/tableTacheRapport.php?NumeroRapport=" + codeTache, true);
        xmlhttp.send();


    }

    function ModifTache() {

        var rd_maintenance = document.getElementById('rd_maintenance').checked;
        var rd_ajout = document.getElementById('rd_ajout').checked;
        var rd_technique = document.getElementById('rd_technique').checked;
        var rd_soft = document.getElementById('rd_soft').checked;
        var txt_observation = document.getElementById('txt_observation').value;
        var spinClient = document.getElementById('spinClient').value;
        var spinRep = document.getElementById('spinAffect').value;
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

        var start = Date.parse($("input#txt_datedebut_ajout").val()); //get timestamp

        //value end
        var end = Date.parse($("input#txt_datefin_ajout").val()); //get timestamp

        totalHours = 0;
        nbminute = 0;
        if (start < end) {
            totalHours = Math.floor((end - start) / 1000 / 60 / 60); //milliseconds: /1000 / 60 / 60
            totalMinute = Math.floor((end - start) / 1000 / 60); //milliseconds: /1000 / 60 / 60
            nbminute = totalMinute - totalHours * 60;
            document.getElementById("txt_datefin_ajout").classList.remove("btn-danger")

        } else {
            document.getElementById("txt_datefin_ajout").className = "btn-danger"

        }

        $("#dureeHeure").val(totalHours);
        $("#dureeMinute").val(nbminute);
    }

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function ajoutLigneRapport() {
        var coderapport = document.getElementById('CodeTache').value;
        var RepAjout = document.getElementById("spinRepAjout").value;
        var ModuleAjout = document.getElementById("spinModuleAjout").value;
        var datedebut_ajout = document.getElementById("txt_datedebut_ajout").value;

        var description_ajout = document.getElementById("txt_description_ajout").value;
        var dureeHeure = document.getElementById("dureeHeure").value;
        var dureeMinute = document.getElementById("dureeMinute").value;

        var table_ajout_ligne_rapport = document.getElementById("table_ajout_ligne_rapport");
        if(        description_ajout == ""        )
        {
            document.getElementById("txt_description_ajout").style.backgroundColor="red"
        }else{
            document.getElementById("txt_description_ajout").style.backgroundColor="white"
        }
        let duree=dureeHeure*60+dureeMinute*1;
        if(        duree <=0      )
        {
            document.getElementById("dureeHeure").style.backgroundColor="red"
            document.getElementById("dureeMinute").style.backgroundColor="red"
        }else{
            document.getElementById("dureeHeure").style.backgroundColor="white"
            document.getElementById("dureeMinute").style.backgroundColor="white"
        }


        if (document.getElementById("spinRepAjout").selectedIndex == 0) {
            RepAjout = "";
        }




        if ( duree <=0   || description_ajout == "") {

            alert("champs obligatoire")

        } else {


            var ligne = table_ajout_ligne_rapport.insertRow(-1);//on a ajouté une ligne
            var colonne1 = ligne.insertCell(0);
            colonne1.innerHTML = RepAjout;
            var colonne2 = ligne.insertCell(1);
            colonne2.innerHTML = ModuleAjout;
            var colonne3 = ligne.insertCell(2);
            colonne3.innerHTML = description_ajout;
            var colonne4 = ligne.insertCell(3);
            colonne4.innerHTML = datedebut_ajout;

            var colonne6 = ligne.insertCell(4);
            colonne6.innerHTML = dureeHeure;
            var colonne7 = ligne.insertCell(5);
            colonne7.innerHTML = dureeMinute;


            var colonne8 = ligne.insertCell(6);
            colonne8.innerHTML = "<button  onclick='deleteRow(this)'  class='btn btn-danger'><i class='fa fa-close' ></i></button>";

            document.getElementById("txt_description_ajout").value = "";
            document.getElementById("dureeHeure").value = "";
            document.getElementById("dureeMinute").value = 0;


        }
    }

    function ValiderRapport() {
        var coderapport = document.getElementById('CodeTache').value;
        var table = document.getElementById("table_ajout_ligne_rapport");
        var arrayLignes = document.getElementById("table_ajout_ligne_rapport").rows; //on récupère les lignes du tableau
        var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
        if (longueur == 1) {
            alert("ajouter au moins une ligne");
        } else {

            for (let i = 1; i < longueur; i++)//on peut directement définir la variable i dans la boucle
            {

                console.error(i);
                var arrayColonnes = arrayLignes[i].cells;//on récupère les cellules de la ligne
                var largeur = arrayColonnes.length;
                let tr = table.getElementsByTagName("tr");
                var RepAjout = (tr[i].getElementsByTagName("td")[0]).innerText;
                var ModuleAjout = (tr[i].getElementsByTagName("td")[1]).innerText;
                var description_ajout = (tr[i].getElementsByTagName("td")[2]).innerText;
                var datedebut_ajout = (tr[i].getElementsByTagName("td")[3]).innerText;

                var dureeHeure = (tr[i].getElementsByTagName("td")[4]).innerText;
                var dureeMinute = (tr[i].getElementsByTagName("td")[5]).innerText;

                if (dureeMinute == '') {
                    dureeMinute = 0;
                }

                var url = "RepAjout=" + RepAjout + "&ModuleAjout=" + ModuleAjout + "&description_ajout=" + description_ajout +
                    "&datedebut_ajout=" + datedebut_ajout + "&dureeHeure=" + dureeHeure +
                    "&dureeMinute=" + dureeMinute + "&coderapport=" + coderapport;
                console.log(i + "Controller/AddLigneRapportToTache.php?", url)

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {

                    if (this.readyState == 4 && this.status == 200) {



                        if (this.responseText == 1) {
                            console.error("longueur" + longueur + "i=" + i);
                            if (i == (longueur - 1) ){
                                console.error(" terminer " + this.responseText)
                                location.reload();
                            }


                        } else {

                            console.error(" re " + this.responseText)
                            // $('#ModalErreur').modal('show');

                        }

                    }
                }
                setTimeout(function () {

                }, 1000);
                xmlhttp.open("GET", "Controller/AddLigneRapportToTache.php?" + url, true);
                xmlhttp.send();


            }
        }

    }


    //Controller/AddLigneRapportToTache.php?RepAjout=&ModuleAjout=00&description_ajout=444&datedebut_ajout=&dureeHeure=5&dureeMinute=0&coderapport=AC21/00004

    function onTimeChangePlannif() {
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

        $("#dureeHeure_plan").val(totalHours);
        $("#dureeMinute_plan").val(nbminute);
    }

    function addSingleTache() {
        var coderapport = document.getElementById('CodeTache').value;
        var dureeHeure_plan = document.getElementById('dureeHeure_plan').value;
        var dureeMinute_plan = document.getElementById('dureeMinute_plan').value;
        var spinModulePlan = document.getElementById('spinModulePlan').value;
        var spinRepPlanif = document.getElementById('spinRepPlanif').value;
        var date_debut = document.querySelector("#datedebut").value;
        var date_fin = document.querySelector("#datefin").value;
        var url = "coderapport=" + coderapport + "&dureeHeure_plan=" + dureeHeure_plan + "&dureeMinute_plan=" + dureeMinute_plan +
            "&spinModulePlan=" + spinModulePlan + "&spinRepPlanif=" + spinRepPlanif + "&date_debut=" + date_debut +
            "&date_fin=" + date_fin;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {

            if (this.responseText == 1) {
                location.reload();
            } else {
                document.getElementById('txt_erreur').innerHTML = " Erreur SQL";

                $('#ModalErreur').modal('show');

            }


        }
        xmlhttp.open("GET", "Controller/AddSingleTache.php?" + url, true);
        xmlhttp.send();


    }

    function AnnulerDemande() {
        var coderapport = document.getElementById('CodeTache').value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {

            if (this.responseText == 1) {
                location.reload();
            } else {
                document.getElementById('txt_erreur').innerHTML = " Erreur SQL" + this.responseText;

                $('#ModalErreur').modal('show');

            }


        }
        xmlhttp.open("GET", "Controller/AnnulAppel.php?CodeAppel=" + coderapport, true);
        xmlhttp.send();
    }
    function showModalRapport()
    {
        var coderapport = document.getElementById('CodeTache').value;

        if(coderapport=="")
        {
            document.getElementById('txt_erreur').innerHTML = "selectionner un rapport";

            $('#ModalErreur').modal('show');
        }else{
        $('#ModalRapport').modal('show');}
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


</html>