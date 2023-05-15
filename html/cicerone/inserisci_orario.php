<?php
session_start();
//Filtra l'attività in base all'id selezionato
$user_data = $_SESSION['utente'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>CicerOne</title>
    <link href="../../css/all.css" rel="stylesheet">
    <link href="../../css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/crea_attività.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f8f9fa">

    <?php
    include('nav.php');
    ?>
    <div class="container container-fluid">
        <h2 class="text-center">Inserisci un nuovo orario per l'attività <?php echo $_SESSION['riproponi']['titolo'] ?></h2>
        <a href="action/call_ricerca_orario.php">
            <-Elenco Orario</a> <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <form method="POST" action="action/call_inserisci_orario.php" enctype="multipart/form-data">
                        <?php require_once("../log/error.php"); ?>
                        <div class="row">
                            <div class="col-md-1 col-lg-1">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-md-3 col-lg-3">
                                <label class="control-label">Inserisci data</label>
                                <div class="form-group">
                                    <div class="input-group" id="picker" style="cursor:pointer;">
                                        <input style="cursor:pointer; background-color:white;" readonly type="text" class="form-control form-control-sm" id="datepicker" name="data_attivita" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text btn"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                        </div>
                                        <script src="../../js/moment.js"></script>
                                        <script src="../../js/pikaday.js"></script>
                                        <script>
                                            var picker = new Pikaday({
                                                field: document.getElementById('datepicker'),
                                                trigger: document.getElementById('picker'),
                                                firstDay: 1,
                                                bound: true,
                                                i18n: {
                                                    previousMonth: 'Mese precedente',
                                                    nextMonth: 'Mese successivo',
                                                    months: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                                                    weekdays: ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'],
                                                    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab']
                                                },
                                                format: 'DD/MM/YYYY',
                                                toString(date, format) {
                                                    // you should do formatting based on the passed format,
                                                    // but we will just return 'D/M/YYYY' for simplicity
                                                    const day = date.getDate();
                                                    const month = date.getMonth() + 1;
                                                    const year = date.getFullYear();
                                                    return `${day}/${month}/${year}`;
                                                },
                                                parse(dateString, format) {
                                                    // dateString is the result of `toString` method
                                                    const parts = dateString.split('/');
                                                    const day = parseInt(parts[0], 10);
                                                    const month = parseInt(parts[1], 10) - 1;
                                                    const year = parseInt(parts[2], 10);
                                                    return new Date(year, month, day);
                                                },
                                                onSelect: function() {
                                                    var date = document.createTextNode(this.getMoment().format('DD/MM/YYYY'));
                                                    console.log(date);
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-3 col-lg-2">
                                <label class="control-label">Ora Inizio</label>
                                <div class="form-group">
                                    <div class="input-group" id="clockpicker" style="cursor:pointer;">
                                        <input style="cursor:pointer; background-color:white;" readonly type="text" class="form-control form-control-sm" name="ora_inizio" placeholder="Inizio" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text btn" id="clockpicker1"><span class="fa fa-clock"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <script src="../../js/clockpicker.js"></script>
                                <script type="text/javascript">
                                    var input = $('#clockpicker').clockpicker({
                                        placement: 'top',
                                        align: 'left',
                                        autoclose: true,
                                        donetext: 'Conferma'
                                    });
                                    $('#clockpicker1').click(function(e) {
                                        // Have to stop propagation here
                                        e.stopPropagation();
                                        input_1.clockpicker('hide');
                                        input.clockpicker('show');
                                    });
                                    $('#clockpicker').click(function(e) {
                                        // Have to stop propagation here
                                        e.stopPropagation();
                                        input_1.clockpicker('hide');
                                        input.clockpicker('show');
                                    });
                                </script>
                            </div>
                            <div class="col-sm-5 col-md-3 col-lg-2">
                                <label class="control-label">Ora Termine</label>
                                <div class="form-group">
                                    <div class="input-group" id="clockpicker_1" style="cursor:pointer;">
                                        <input style="cursor:pointer; background-color:white;" readonly type="text" class="form-control form-control-sm" name="ora_termine" placeholder="Ora Fine">
                                        <div class="input-group-append">
                                            <div class="input-group-text btn" id="clockpicker1_1"><span class="fa fa-clock"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <script src="../../js/clockpicker.js"></script> -->
                                <script type="text/javascript">
                                    var input_1 = $('#clockpicker_1').clockpicker({
                                        placement: 'top',
                                        align: 'left',
                                        autoclose: true,
                                        donetext: 'Conferma'
                                    });
                                    $('#clockpicker1_1').click(function(e) {
                                        // Have to stop propagation here
                                        e.stopPropagation();
                                        input.clockpicker('hide');
                                        input_1.clockpicker('show');
                                    });
                                    $('#clockpicker_1').click(function(e) {
                                        // Have to stop propagation here
                                        e.stopPropagation();
                                        input.clockpicker('hide');
                                        input_1.clockpicker('show');
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="margin:auto;">
                                <input style="margin-top:1rem" type="submit" class="btn btn-primary btn-block btn-lg" value="Inserisci Data" />
                            </div>
                        </div>
                    </form>
                </div>
    </div>
    </div>




</body>