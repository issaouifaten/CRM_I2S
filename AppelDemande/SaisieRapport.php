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


                    <div class="col-6 col-md-6">


                        <div class="row">

                            <div class="col-md-12   p-2 m-2 card">


                                <div class="row">
                                    <div class="col-md-6">
                                        CLIENT
                                        <select id="spinClient_recherche"
                                                onchange=" fillListDocument()"
                                                class="col-md-12 form-control  select2    select2-danger">
                                            <option>Tout</option>
                                            <?php require "Controller/SpinClient.php" ?>
                                        </select>


                                    </div>


                                    <div class="col-md-4 " hidden>
                                        <label class="col-md-12"> <br><input onchange="toggleShow()" type="checkbox">
                                            Nouveau Rapport</label>
                                    </div>


                                </div>
                            </div>


                            <div class="col-md-12 row p-2 m-2 card">
                                <div class="col-md-6" id="div_rapport">

                                    Selectionnez un Rapport

                                    <select id="spinRapportClient"
                                            onchange=" fillListRapport"
                                            class="col-md-12 form-control  select2    select2-danger">

                                    </select>

                                </div>
                                <div class="col-md-12" hidden id="div_nv_rapport">
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
                                            <label>Observation</label>
                                        </div>
                                        <div class="col-md-4">
                                            <textarea id="txt_observation" class="form-control" rows="5"></textarea>
                                        </div>

                                    </div>
                                    <div class="row p-2">

                                        <div class="col-md-2">
                                            <label>Degres</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="spinDegres"
                                                    class="col-md-12 form-control select2 select2-danger">
                                                <?php require "Controller/SpinDegres.php" ?>
                                            </select>
                                        </div>

                                    </div>


                                </div>
                            </div>


                            <div class="col-md-12 card m-2 p-2  row">
                                <div class="col-md-12  p-2 m-2 row">

                                    <div class="col-md-3">
                                        Affect
                                        <select id="spinRepAjout" class="form-control">
                                            <?php require "Controller/SpinRespensable.php" ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Module
                                        <select id="spinModuleAjout" class="form-control">
                                            <?php require "Controller/SpinModule.php" ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        Date Début
                                        <input type="date" class="form-control" id="txt_datedebut_ajout">
                                    </div>


                                    <div class="col-md-2">
                                        H
                                        <input type="number" class="form-control" value="0" id="dureeHeure">
                                    </div>
                                    <div class="col-md-2">
                                        min
                                        <input type="number" class="form-control" value="0" id="dureeMinute">
                                    </div>
                                </div>

                                <div class="col-md-12 row p-1">
                                    <div class="col-md-7">
                                        Description
                                        <textarea type="text" id="txt_description_ajout" class="form-control"
                                                  placeholder="description"></textarea>
                                    </div>


                                    <div class="col-md-5 ">
                                        <br>
                                        <div class="btn-group">
                                            <button onclick="ajoutLigneRapport()" class="btn btn-info"><i
                                                        class="fa fa-plus"> </i>ligne


                                            </button>
                                            <button class="btn btn-danger" onclick="ValiderRapport()"> <i class="fa fa-check"></i> Valider Rapport
                                            </button>
                                            </center>
                                        </div>
                                    </div>

                                </div>


                                <div class="row  col-md-12 ">
                                    <table id="table_ajout_ligne_rapport" class="table   table-bordered">

                                        <tr>

                                            <td width="15%"> Affect</td>
                                            <td width="10%"> Module</td>
                                            <td width="30%">Description</td>
                                            <td width="15%">Date</td>
                                            <td width="10%">H</td>
                                            <td width="10%">min</td>
                                            <td></td>
                                        </tr>
                                        <tbody id="data_ajout" class="overflow-auto"></tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-6 col-md-6    ">

                        <div class="row p-1   ">


                            <div class="col-md-6">
                                Document (Rapport PV)
                                <select id="spinDocumant_recherche"
                                        onchange=" chargerDocumentFile() "
                                        class="col-md-12 form-control  ">


                                </select>


                            </div>

                            <div class="col-md-12 p-1">
                                <div id="contenuDocument"></div>
                            </div>
                        </div>


                    </div>

                </div>
                <br><br><br>
                <br><br><br>
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

    function toggleShow() {

        document.getElementById("div_nv_rapport").hidden = !document.getElementById("div_nv_rapport").hidden
        document.getElementById("div_rapport").hidden = !document.getElementById("div_rapport").hidden
    }


    function fillListDocument() {

        var codeClientSelected = document.getElementById("spinClient_recherche").value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('spinDocumant_recherche').innerHTML = this.responseText;
                console.error("listDoc", this.responseText)
            }
        }
        xmlhttp.open("GET", "Controller/spinDocument.php?CodeClient=" + codeClientSelected, true);
        xmlhttp.send();


        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('spinRapportClient').innerHTML = this.responseText;
                console.error("listDoc", this.responseText)
            }
        }
        xmlhttp.open("GET", "Controller/spinRapportClient.php?CodeClient=" + codeClientSelected, true);
        xmlhttp.send();

    }


    function chargerDocumentFile() {
        var codeDocumentSelected = document.getElementById("spinDocumant_recherche").value;

        console.error("servicr")
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            console.error("status", this.status)
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('contenuDocument').innerHTML = this.responseText;

            }
        }
        xmlhttp.open("GET", "Controller/chargerDocuments.php?CodeDocument=" + codeDocumentSelected, true);
        xmlhttp.send();

    }

    function ajoutLigneRapport() {
        var coderapport = document.getElementById('spinRapportClient').value;
        var RepAjout = document.getElementById("spinRepAjout").value;
        var ModuleAjout = document.getElementById("spinModuleAjout").value;
        var datedebut_ajout = document.getElementById("txt_datedebut_ajout").value;

        var description_ajout = document.getElementById("txt_description_ajout").value;
        var dureeHeure = document.getElementById("dureeHeure").value;
        var dureeMinute = document.getElementById("dureeMinute").value;

        var table_ajout_ligne_rapport = document.getElementById("table_ajout_ligne_rapport");
        if (description_ajout == "") {
            document.getElementById("txt_description_ajout").style.backgroundColor = "red"
        } else {
            document.getElementById("txt_description_ajout").style.backgroundColor = "white"
        }
        let duree = dureeHeure * 60 + dureeMinute * 1;
        if (duree <= 0) {
            document.getElementById("dureeHeure").style.backgroundColor = "red"
            document.getElementById("dureeMinute").style.backgroundColor = "red"
        } else {
            document.getElementById("dureeHeure").style.backgroundColor = "white"
            document.getElementById("dureeMinute").style.backgroundColor = "white"
        }


        if (document.getElementById("spinRepAjout").selectedIndex == 0) {
            RepAjout = "";
        }


        if (duree <= 0 || description_ajout == "") {

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

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }




    function ValiderRapport() {
        var coderapport = document.getElementById('spinRapportClient').value;
        var table = document.getElementById("table_ajout_ligne_rapport");
        var arrayLignes = document.getElementById("table_ajout_ligne_rapport").rows; //on récupère les lignes du tableau
        var longueur = arrayLignes.length;//on peut donc appliquer la propriété length

        if (coderapport == "") {
            alert("selectionner un rapport");
        } else
        if (longueur == 1) {
            alert("ajouter au moins une ligne");
        } else {

            for (let i = 1; i < longueur; i++)//on peut directement définir la variable i dans la boucle
            {

                console.error(i);
                var arrayColonnes = arrayLignes[i].cells;//on récupère les cellules de la ligne
                var largeur = arrayColonnes.length;
                let tr = table.getElementsByTagName("tr");// matric
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

                        console.error("longueur" + longueur + "i=" + i);

                        if (this.responseText == 1) {

                            if (i == longueur - 1) {
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
</script>


<script type="text/javascript">


</script>

</html>