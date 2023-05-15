<?php
session_start();
include("../log/error.php");
$user_data = $_SESSION['utente'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="icona.gif" />
    <title>CicerOne</title>
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/activity.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f8f9fa">
    <?php
    include "nav.php";

    ?>

    <div class="container">
        <h2 class="text-center">Itinerario per <?php echo $_SESSION['selected_activity']['titolo'] ?></h2>
        <a href="action/call_ricerca_attivita.php">

            <-Le mie attività</a> <div class="row line">
                <?php include "../log/error.php"; ?>
                <div class="col-4 col-sm-4 col-md-2 col-lg-2"><strong>Nome Luogo</strong></div>
                <div class="col-4 col-sm-4 col-md-2 col-lg-2"><strong>Descrizione</strong></div>
    </div>
    <?php
    if (isset($_SESSION['itinerario'])) {
        require('root_table.php');
    }
    ?>
    <div class="row justify-content-center" style="margin-top:15px;">
        <div class="col-5 col-sm-3">
            <a href="inserisci_tappa.php">
                <button class="btn btn-primary btn-block"><i class="fas fa-plus"></i></button>
            </a>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top:15px;">
        <div class="col-5 col-sm-3">
            <a href="action/call_elimina_itinerario.php">
                <button class="btn btn-danger btn-block">Elimina Itinerario</button>
            </a>
        </div>
    </div>


</body>

</html>