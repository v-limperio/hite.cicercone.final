<?php
session_start();
//Filtra l'attività in base all'id selezionato
$user_data = $_SESSION['utente'];

$array = explode(" ", $_POST['index']);

$_SESSION['segnala']['id'] = $array[0];
$_SESSION['segnala']['nome'] = $array[1];
$_SESSION['segnala']['cognome'] = $array[2];
$_SESSION['segnala']['segnalazioni'] = $array[3];
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
        <h2 class="text-center">Segnala <?php echo $_SESSION['segnala']['nome'] . " " . $_SESSION['segnala']['cognome'] ?></h2>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <form method="POST" action="tmp/call_segnalazione_utente.php" enctype="multipart/form-data">
                    <?php require_once("../log/error.php"); ?>
                    <div class="row">
                        <div class="col-md-1 col-lg-1">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-4 col-lg-4">
                            <label class="control-label">Inserisci la causa della segnalazione</label>
                            <select required class="form-control form-control-sm" name="causa">
                                <option selected disabled>Causa..</option>
                                <option>Comportamento Offensivo</option>
                                <option>Tentativo di Truffa</option>
                                <option>Assenza ingiustificata del Cicerone</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 col-md-12 col-lg-12">
                            <label class="control-label">Descirivi il motivo della segnalazione</label>
                            <textarea class="form-control form-control-lg" name="descrizione_causa" style="font-size: medium;" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin:auto;">
                            <input style="margin-top:1rem" type="submit" class="btn btn-danger btn-block btn-lg" value="Segnala Utente" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




</body>